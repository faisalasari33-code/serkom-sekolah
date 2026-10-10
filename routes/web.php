<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EkstrakurikulerController;

// ==========================================
// ROUTE PUBLIK / LANDING PAGE (TANPA AUTH)
// ==========================================
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/berita-sekolah', [LandingController::class, 'beritaIndex'])->name('landing.berita');
Route::get('/galeri-sekolah', [LandingController::class, 'galeriIndex'])->name('landing.galeri');
Route::get('/eskul-sekolah', [LandingController::class, 'eskulIndex'])->name('landing.eskul');
Route::get('/guru-staf', [LandingController::class, 'guruIndex'])->name('landing.guru');
Route::get('/profil-sekolah', [LandingController::class, 'profilIndex'])->name('landing.profil');

Route::get('/berita-sekolah/{id}', [LandingController::class, 'beritaDetail'])->name('landing.berita.detail');
Route::get('/guru-staf/{id}', [LandingController::class, 'guruDetail'])->name('landing.guru.detail');
Route::get('/eskul-sekolah/{id}', [LandingController::class, 'eskulDetail'])->name('landing.eskul.detail');
Route::get('/galeri-sekolah', [LandingController::class, 'galeriDetail'])->name('landing.galeri');
Route::get('/galeri-sekolah/{id}', [LandingController::class, 'galeriDetail'])->name('landing.galeri.detail');

// AUTHENTICATION
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('auth', [AuthController::class, 'auth'])->name('auth');

// ==========================================
// ROUTE ADMIN / DASHBOARD (MEMAKAI CHECKAUTH)
// ==========================================
Route::middleware('checkauth')->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/tambah', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita/simpan', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/hapus/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/tambah', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri/simpan', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/edit/{id}', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/hapus/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/ekstrakulikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakulikuler.index');
    Route::get('/ekstrakulikuler/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
    Route::post('/ekstrakulikuler', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakulikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit');
    Route::put('/ekstrakulikuler/{id}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
    Route::delete('/ekstrakulikuler/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile-sekolah/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile-sekolah/update', [ProfileController::class, 'update'])->name('profile.update');
});