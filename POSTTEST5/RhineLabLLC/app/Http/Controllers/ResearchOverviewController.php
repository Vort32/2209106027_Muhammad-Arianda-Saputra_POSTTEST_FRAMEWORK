<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ResearchOverviewController extends Controller
{
    public function index()
    {
        $primaryUser = null;
        $authUser = Auth::user();

        if ($authUser) {
            $primaryUser = User::withCount('researchRecords')
                ->with([
                    'researchRecords' => function ($query) {
                        $query->latest('recorded_at')
                            ->with(['project.division', 'documents', 'user.division']);
                    },
                ])
                ->find($authUser->id);
        }

        if (!$primaryUser) {
            $primaryUser = User::withCount('researchRecords')
                ->with([
                    'researchRecords' => function ($query) {
                        $query->latest('recorded_at')
                            ->with(['project.division', 'documents', 'user.division']);
                    },
                ])
                ->orderByDesc('research_records_count')
                ->first();
        }

        if (!$primaryUser) {
            return view('research-overview', [
                'primaryUser' => null,
                'divisions' => collect(),
            ]);
        }

        $divisions = Division::with([
            'head',
            'projects' => function ($query) {
                $query->orderBy('title')
                    ->with([
                        'records' => function ($recordQuery) {
                            $recordQuery->latest('recorded_at')
                                ->with(['documents', 'user.division', 'project.division']);
                        },
                    ]);
            },
        ])->orderBy('name')->get();

        return view('research-overview', compact('primaryUser', 'divisions'));
    }
}
