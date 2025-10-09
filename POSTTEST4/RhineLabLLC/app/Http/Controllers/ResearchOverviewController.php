<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;

class ResearchOverviewController extends Controller
{
    public function index()
    {
        $primaryUser = User::withCount('researchRecords')
            ->with([
                'researchRecords' => function ($query) {
                    $query->latest('recorded_at')
                        ->with(['project.division', 'documents', 'user']);
                },
            ])
            ->orderByDesc('research_records_count')
            ->first();

        if (!$primaryUser) {
            return view('research-overview', [
                'primaryUser' => null,
                'divisions' => collect(),
            ]);
        }

        $divisions = Division::with([
            'projects' => function ($query) {
                $query->orderBy('title')
                    ->with([
                        'records' => function ($recordQuery) {
                            $recordQuery->latest('recorded_at')
                                ->with(['documents', 'user', 'project.division']);
                        },
                    ]);
            },
        ])->orderBy('name')->get();

        return view('research-overview', compact('primaryUser', 'divisions'));
    }
}
