<?php

namespace App\Http\Controllers;

use App\Models\ResearchRecord;

class GalleryController extends Controller
{
    public function index()
    {
        $records = ResearchRecord::with(['user', 'project.division'])
            ->latest('recorded_at')
            ->take(9)
            ->get();

        return view('gallery', [
            'records' => $records,
        ]);
    }
}
