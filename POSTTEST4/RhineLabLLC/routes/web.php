<?php
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ResearchOverviewController;
use App\Models\Material;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    return view('rhine-lab');
});

Route::get('/rhineinfo', function () {
    $files = Material::all(); // ambil semua data dari tabel materials
    return view('rhineinfo', compact('files'));
});

Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/research-ledger', [ResearchOverviewController::class, 'index'])->name('research.ledger');
