<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DivisionProjectController extends Controller
{
    public function index(): View
    {
        $user = $this->ensureHeadWithDivision();

        $projects = ResearchProject::with('division')
            ->where('division_id', $user->division_id)
            ->latest('initiated_at')
            ->latest('created_at')
            ->paginate(8);

        return view('division-projects.index', [
            'projects' => $projects,
            'statuses' => $this->statuses(),
            'division' => $user->division,
        ]);
    }

    public function create(): View
    {
        $user = $this->ensureHeadWithDivision();

        return view('division-projects.create', [
            'statuses' => $this->statuses(),
            'division' => $user->division,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $this->ensureHeadWithDivision();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'reference_code' => ['required', 'string', 'max:100', Rule::unique('research_projects', 'reference_code')],
            'status' => ['required', 'string', 'max:100'],
            'initiated_at' => ['nullable', 'date'],
            'objective' => ['nullable', 'string'],
        ]);

        ResearchProject::create([
            'division_id' => $user->division_id,
            'title' => $data['title'],
            'reference_code' => strtoupper($data['reference_code']),
            'status' => $data['status'],
            'initiated_at' => $data['initiated_at'] ?? null,
            'objective' => $data['objective'] ?? null,
        ]);

        return redirect()
            ->route('division-projects.index')
            ->with('status', 'Proyek riset divisi berhasil dibuat.');
    }

    public function edit(ResearchProject $divisionProject): View
    {
        $user = $this->ensureHeadWithDivision();
        $this->ensureProjectBelongsToDivision($divisionProject, $user->division_id);

        return view('division-projects.edit', [
            'project' => $divisionProject,
            'statuses' => $this->statuses(),
            'division' => $user->division,
        ]);
    }

    public function update(Request $request, ResearchProject $divisionProject): RedirectResponse
    {
        $user = $this->ensureHeadWithDivision();
        $this->ensureProjectBelongsToDivision($divisionProject, $user->division_id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'reference_code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('research_projects', 'reference_code')->ignore($divisionProject->id),
            ],
            'status' => ['required', 'string', 'max:100'],
            'initiated_at' => ['nullable', 'date'],
            'objective' => ['nullable', 'string'],
        ]);

        $divisionProject->update([
            'title' => $data['title'],
            'reference_code' => strtoupper($data['reference_code']),
            'status' => $data['status'],
            'initiated_at' => $data['initiated_at'] ?? null,
            'objective' => $data['objective'] ?? null,
        ]);

        return redirect()
            ->route('division-projects.index')
            ->with('status', 'Proyek riset divisi diperbarui.');
    }

    public function destroy(ResearchProject $divisionProject): RedirectResponse
    {
        $user = $this->ensureHeadWithDivision();
        $this->ensureProjectBelongsToDivision($divisionProject, $user->division_id);

        if ($divisionProject->records()->exists()) {
            return redirect()
                ->route('division-projects.index')
                ->with('status', 'Proyek tidak dapat dihapus karena memiliki catatan aktif.');
        }

        $divisionProject->delete();

        return redirect()
            ->route('division-projects.index')
            ->with('status', 'Proyek riset divisi dihapus.');
    }

    protected function ensureHeadWithDivision()
    {
        $user = Auth::user();

        if (!$user || !$user->is_division_head) {
            abort(403);
        }

        if (!$user->division_id) {
            abort(422, 'Kepala divisi belum terhubung ke divisi mana pun.');
        }

        return $user;
    }

    protected function ensureProjectBelongsToDivision(ResearchProject $project, int $divisionId): void
    {
        if ($project->division_id !== $divisionId) {
            abort(403);
        }
    }

    /**
     * @return array<int, string>
     */
    protected function statuses(): array
    {
        return ['aktif', 'dalam evaluasi', 'selesai'];
    }
}
