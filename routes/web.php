<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\DokumenNasabahController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Nasabah Routes
    Route::resource('nasabah', NasabahController::class);
    
    // Kredit Routes
    Route::resource('kredit', KreditController::class);
    
    // Dokumen Routes
    Route::get('dokumen/{dokumen}/download', [DokumenNasabahController::class, 'download'])->name('dokumen.download');
    Route::resource('dokumen', DokumenNasabahController::class)->except(['edit', 'update']);
    Route::get('/dokumen/{id}/edit', [DokumenNasabahController::class, 'edit'])->name('dokumen.edit');
    Route::put('/dokumen/{id}', [DokumenNasabahController::class, 'update'])->name('dokumen.update');

    // Laporan Routes
    Route::get('laporan/riwayat', [LaporanController::class, 'riwayat'])->name('laporan.riwayat');
    Route::resource('laporan', LaporanController::class)->except(['edit', 'update']);
    
    // Admin Only Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });
});

require __DIR__.'/auth.php';