<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\AspirasiController as AdminAspirasi;
use App\Http\Controllers\Admin\PelakuController as AdminPelaku;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasi;

// ===== AUTH ROUTES =====
Route::get('/', fn() => redirect('/login'));
Route::get('/login', [LoginController::class, 'form'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ===== ADMIN ROUTES =====
Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    
    // Aspirasi
    Route::get('/aspirasi', [AdminAspirasi::class, 'index'])->name('admin.aspirasi.index');
    Route::get('/aspirasi/histori', [AdminAspirasi::class, 'histori'])->name('admin.aspirasi.histori');
    Route::get('/aspirasi/arsip', [AdminAspirasi::class, 'arsip'])->name('admin.aspirasi.arsip'); // Moved up
    Route::patch('/aspirasi/{id}/archive', [AdminAspirasi::class, 'archive'])->name('admin.aspirasi.archive'); // Moved up
    Route::get('/aspirasi/{id}', [AdminAspirasi::class, 'show'])->name('admin.aspirasi.show');
    Route::patch('/aspirasi/{id}/status', [AdminAspirasi::class, 'updateStatus'])->name('admin.aspirasi.updateStatus');
    Route::patch('/aspirasi/{id}/feedback', [AdminAspirasi::class, 'updateFeedback'])->name('admin.aspirasi.updateFeedback');
    
    // Pelaku (Deprecated sidebar link, kept for logic)
    Route::get('/pelaku', [AdminPelaku::class, 'index'])->name('admin.pelaku.index');
    Route::post('/pelaku', [AdminPelaku::class, 'store'])->name('admin.pelaku.store');
    Route::delete('/pelaku/{id}', [AdminPelaku::class, 'destroy'])->name('admin.pelaku.destroy');

    // Siswa
    Route::resource('siswa', \App\Http\Controllers\Admin\SiswaController::class, ['as' => 'admin']);
});

// ===== SISWA ROUTES =====
Route::prefix('siswa')->middleware(\App\Http\Middleware\SiswaMiddleware::class)->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('siswa.dashboard');
    
    // Aspirasi
    Route::get('/aspirasi', [SiswaAspirasi::class, 'index'])->name('siswa.aspirasi.index');
    Route::get('/aspirasi/create', [SiswaAspirasi::class, 'create'])->name('siswa.aspirasi.create');
    Route::post('/aspirasi', [SiswaAspirasi::class, 'store'])->name('siswa.aspirasi.store');
    Route::get('/aspirasi/histori', [SiswaAspirasi::class, 'histori'])->name('siswa.aspirasi.histori');
    Route::get('/aspirasi/{id}', [SiswaAspirasi::class, 'show'])->name('siswa.aspirasi.show');
});
