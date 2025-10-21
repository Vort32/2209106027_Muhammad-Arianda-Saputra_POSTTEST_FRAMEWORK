<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\ResearchProject;
use App\Models\ResearchRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ResearchRecordController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user?->is_division_head) {
            $query = ResearchRecord::with(['project.division', 'user', 'approver'])
                ->whereHas('project', function ($builder) use ($user) {
                    $builder->where('division_id', $user->division_id);
                })
                ->latest('recorded_at')
                ->latest('created_at');

            $pendingQuery = (clone $query)->where('approval_status', 'pending');
            $pendingRecords = (clone $pendingQuery)->take(8)->get();
            $pendingCount = $pendingQuery->count();
            $records = $query->paginate(10);

            return view('research-records.head-index', [
                'records' => $records,
                'pendingRecords' => $pendingRecords,
                'pendingCount' => $pendingCount,
                'division' => $user->division,
            ]);
        }

        $records = ResearchRecord::with(['project.division'])
            ->where('user_id', $user?->id)
            ->latest('recorded_at')
            ->latest('created_at')
            ->paginate(8);

        return view('research-records.index', [
            'records' => $records,
        ]);
    }

    public function create(): View
    {
        $user = Auth::user();
        $divisionId = $user?->division_id;

        return view('research-records.create', [
            'projects' => $user?->is_division_head ? $this->projects($divisionId) : $this->projects(),
            'classifications' => $this->classifications(),
            'statuses' => $this->statuses(),
            'divisions' => $user?->is_division_head ? $this->divisions($divisionId) : $this->divisions(),
            'isDivisionHead' => $user?->is_division_head ?? false,
            'userDivision' => $user?->division,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $rules = [
            'research_project_id' => ['required', Rule::exists('research_projects', 'id')],
            'classification' => ['required', Rule::in($this->classifications())],
            'status' => ['required', Rule::in($this->statuses())],
            'recorded_at' => ['nullable', 'date'],
            'summary' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];

        if (!$user?->is_division_head) {
            $rules['division_id'] = ['required', Rule::exists('divisions', 'id')];
        }

        $data = $request->validate($rules);

        $projectId = (int) $data['research_project_id'];
        $divisionId = $user?->is_division_head ? (int) $user->division_id : (int) ($data['division_id'] ?? 0);

        if (!$divisionId) {
            throw ValidationException::withMessages([
                'division_id' => 'Divisi tidak ditemukan untuk pengguna ini.',
            ]);
        }

        $project = ResearchProject::findOrFail($projectId);
        $this->assertProjectDivision($project, $divisionId);
        $recordCode = $this->generateRecordCode($project);
        $imagePath = $request->hasFile('image')
            ? $this->storeImage($request->file('image'))
            : null;

        $isHead = $user?->is_division_head;

        ResearchRecord::create([
            'research_project_id' => $projectId,
            'user_id' => Auth::id(),
            'record_code' => $recordCode,
            'classification' => $data['classification'],
            'status' => $isHead ? 'final' : $data['status'],
            'recorded_at' => $data['recorded_at'] ?? null,
            'summary' => $data['summary'],
            'image_path' => $imagePath,
            'approval_status' => $isHead ? 'approved' : 'pending',
            'approved_by' => $isHead ? $user?->id : null,
            'approved_at' => $isHead ? now() : null,
        ]);

        return redirect()
            ->route('research-records.index')
            ->with('status', 'Catatan riset berhasil dibuat.');
    }

    public function show(ResearchRecord $researchRecord): View
    {
        $this->authorizeRecordAccess($researchRecord);

        $researchRecord->load(['project.division', 'user', 'approver']);

        return view('research-records.show', [
            'record' => $researchRecord,
        ]);
    }

    public function edit(ResearchRecord $researchRecord): View
    {
        $this->ensureOwnership($researchRecord);

        $user = Auth::user();
        $divisionId = $user?->division_id;

        return view('research-records.edit', [
            'record' => $researchRecord,
            'projects' => $user?->is_division_head ? $this->projects($divisionId) : $this->projects(),
            'classifications' => $this->classifications(),
            'statuses' => $this->statuses(),
            'divisions' => $user?->is_division_head ? $this->divisions($divisionId) : $this->divisions(),
            'isDivisionHead' => $user?->is_division_head ?? false,
            'userDivision' => $user?->division,
        ]);
    }

    public function update(Request $request, ResearchRecord $researchRecord): RedirectResponse
    {
        $this->ensureOwnership($researchRecord);

        $user = Auth::user();
        $rules = [
            'research_project_id' => ['required', Rule::exists('research_projects', 'id')],
            'classification' => ['required', Rule::in($this->classifications())],
            'status' => ['required', Rule::in($this->statuses())],
            'recorded_at' => ['nullable', 'date'],
            'summary' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];

        if (!$user?->is_division_head) {
            $rules['division_id'] = ['required', Rule::exists('divisions', 'id')];
        }

        $data = $request->validate($rules);

        $projectId = (int) $data['research_project_id'];
        $divisionId = $user?->is_division_head ? (int) $user->division_id : (int) ($data['division_id'] ?? 0);

        if (!$divisionId) {
            throw ValidationException::withMessages([
                'division_id' => 'Divisi tidak ditemukan untuk pengguna ini.',
            ]);
        }

        $recordCode = $researchRecord->record_code;

        if ($researchRecord->research_project_id !== $projectId) {
            $project = ResearchProject::findOrFail($projectId);
            $this->assertProjectDivision($project, $divisionId);
            $recordCode = $this->generateRecordCode($project);
        } else {
            $project = $researchRecord->project ?? ResearchProject::findOrFail($projectId);
            $this->assertProjectDivision($project, $divisionId);
        }

        $imagePath = $researchRecord->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'));
            $this->deleteImage($researchRecord->image_path);
        }

        $researchRecord->update([
            'research_project_id' => $projectId,
            'record_code' => $recordCode,
            'classification' => $data['classification'],
            'status' => $user?->is_division_head ? 'final' : $data['status'],
            'recorded_at' => $data['recorded_at'] ?? null,
            'summary' => $data['summary'],
            'image_path' => $imagePath,
            'approval_status' => $user?->is_division_head ? 'approved' : 'pending',
            'approved_by' => $user?->is_division_head ? $user->id : null,
            'approved_at' => $user?->is_division_head ? now() : null,
        ]);

        return redirect()
            ->route('research-records.index')
            ->with('status', 'Catatan riset berhasil diperbarui.');
    }

    public function destroy(ResearchRecord $researchRecord): RedirectResponse
    {
        $this->ensureOwnership($researchRecord);

        $this->deleteImage($researchRecord->image_path);

        $researchRecord->delete();

        return redirect()
            ->route('research-records.index')
            ->with('status', 'Catatan riset berhasil dihapus.');
    }

    public function approve(Request $request, ResearchRecord $researchRecord): RedirectResponse
    {
        $this->ensureDivisionHeadAccess($researchRecord);

        if ($researchRecord->approval_status !== 'approved') {
            $researchRecord->update([
                'approval_status' => 'approved',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
                'status' => 'final',
            ]);
        }

        return back()->with('status', 'Catatan riset disetujui.');
    }

    public function reject(Request $request, ResearchRecord $researchRecord): RedirectResponse
    {
        $this->ensureDivisionHeadAccess($researchRecord);

        $researchRecord->update([
            'approval_status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('status', 'Catatan riset ditolak.');
    }

    protected function ensureOwnership(ResearchRecord $record): void
    {
        if ($record->user_id !== Auth::id()) {
            abort(403);
        }
    }

    protected function authorizeRecordAccess(ResearchRecord $record): void
    {
        $record->loadMissing('project');
        $user = Auth::user();

        if ($record->user_id === $user?->id) {
            return;
        }

        if ($user?->is_division_head && optional($record->project)->division_id === $user->division_id) {
            return;
        }

        abort(403);
    }

    protected function ensureDivisionHeadAccess(ResearchRecord $record): void
    {
        $record->loadMissing('project');
        $user = Auth::user();

        if (!$user?->is_division_head || optional($record->project)->division_id !== $user->division_id) {
            abort(403);
        }
    }

    /**
     * @return array<int, array{id: int, name: string, code: string|null, lead_scientist: string|null}>
     */
    protected function divisions(?int $onlyId = null): array
    {
        $query = Division::with('head')->orderBy('name');

        if ($onlyId) {
            $query->where('id', $onlyId);
        }

        return $query
            ->get(['id', 'name', 'code', 'lead_scientist'])
            ->map(function (Division $division) {
                return [
                    'id' => $division->id,
                    'name' => $division->name,
                    'code' => $division->code,
                    'lead_scientist' => $division->lead_scientist,
                    'head_user_name' => $division->head?->name,
                ];
            })
            ->all();
    }

    /**
     * @return array<int, array{id: int, title: string, reference_code: string|null, division_id: int|null}>
     */
    protected function projects(?int $divisionId = null): array
    {
        $query = ResearchProject::orderBy('title');

        if ($divisionId) {
            $query->where('division_id', $divisionId);
        }

        return $query
            ->get(['id', 'title', 'reference_code', 'division_id'])
            ->map(function (ResearchProject $project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'reference_code' => $project->reference_code,
                    'division_id' => $project->division_id,
                ];
            })
            ->all();
    }

    /**
     * @return array<int, string>
     */
    protected function classifications(): array
    {
        return ['internal', 'restricted', 'rahasia'];
    }

    /**
     * @return array<int, string>
     */
    protected function statuses(): array
    {
        return ['draft', 'review', 'final'];
    }

    protected function generateRecordCode(ResearchProject $project): string
    {
        $base = $project->reference_code ?: 'REC';
        $base = Str::upper(Str::slug($base, '-'));
        $sequence = ResearchRecord::where('research_project_id', $project->id)->count() + 1;

        $code = sprintf('%s-%03d', $base, $sequence);

        while (ResearchRecord::where('record_code', $code)->exists()) {
            $sequence += 1;
            $code = sprintf('%s-%03d', $base, $sequence);
        }

        return $code;
    }

    protected function storeImage(UploadedFile $file): string
    {
        $directory = public_path('uploads/research_records');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = uniqid('research_', true) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'uploads/research_records/' . $filename;
    }

    protected function deleteImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    protected function assertProjectDivision(ResearchProject $project, int $divisionId): void
    {
        if ($project->division_id !== $divisionId) {
            throw ValidationException::withMessages([
                'research_project_id' => 'Proyek yang dipilih tidak terhubung dengan kepala divisi yang dipilih.',
            ]);
        }
    }
}
