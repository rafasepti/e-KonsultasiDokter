<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpesialisasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin/v_admin');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'checkRole:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'checkRole:admin')->group(function () {
    Route::get('/spesialisasi', [SpesialisasiController::class, 'index'])->name('spesialisasi');
    Route::get('/spesialisasi/list', [SpesialisasiController::class, 'spesialisasiGet']);
    Route::get('/spesialisasi/tambah', [SpesialisasiController::class, 'create']);
    Route::post('/spesialisasi/store', [SpesialisasiController::class, 'store']);
    Route::get('/spesialisasi/edit/{id}', [SpesialisasiController::class, 'edit']);
    Route::post('/spesialisasi/update', [SpesialisasiController::class, 'update']);
    Route::get('/spesialisasi/hapus/{id}', [SpesialisasiController::class, 'destroy']);

    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::get('/dokter/list', [DokterController::class, 'dokterGet']);
    Route::get('/dokter/tambah', [DokterController::class, 'create']);
    Route::get('/dokter/jadwal/{id}', [DokterController::class, 'jadwal']);
    Route::post('/dokter/store', [DokterController::class, 'store']);
    Route::get('/dokter/edit/{id}', [DokterController::class, 'edit']);
    Route::post('/dokter/update', [DokterController::class, 'update']);
    Route::get('/dokter/hapus/{id}', [DokterController::class, 'destroy']);
});

require __DIR__.'/auth.php';
