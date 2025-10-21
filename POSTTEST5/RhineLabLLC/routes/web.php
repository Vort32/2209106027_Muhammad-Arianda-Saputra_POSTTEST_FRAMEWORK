<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionProjectController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ResearchOverviewController;
use App\Http\Controllers\ResearchRecordController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'showLogoutView'])->name('logout.view');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('research-records/{researchRecord}/approve', [ResearchRecordController::class, 'approve'])->name('research-records.approve');
    Route::post('research-records/{researchRecord}/reject', [ResearchRecordController::class, 'reject'])->name('research-records.reject');
    Route::resource('research-records', ResearchRecordController::class);
    Route::resource('division-projects', DivisionProjectController::class)->except(['show']);
});
