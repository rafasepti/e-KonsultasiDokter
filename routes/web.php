<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpesialisasiController;
use App\Http\Controllers\UserController;
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
    Route::post('/dokter/jadwalStore', [DokterController::class, 'jadwalStore']);
    Route::get('/dokter/edit/{id}', [DokterController::class, 'edit']);
    Route::post('/dokter/update', [DokterController::class, 'update']);
    Route::get('/dokter/hapus/{id}', [DokterController::class, 'destroy']);

    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
    Route::get('/petugas/list', [PetugasController::class, 'petugasGet']);
    Route::get('/petugas/tambah', [PetugasController::class, 'create']);
    Route::post('/petugas/store', [PetugasController::class, 'store']);
    Route::get('/petugas/edit/{id}', [PetugasController::class, 'edit']);
    Route::post('/petugas/update', [PetugasController::class, 'update']);
    Route::get('/petugas/hapus/{id}', [PetugasController::class, 'destroy']);

    Route::get('/akun', [UserController::class, 'index'])->name('akun');
    Route::get('/akun/list', [UserController::class, 'userGet']);
    Route::get('/akun/tambah', [UserController::class, 'create']);
    Route::post('/akun/store', [UserController::class, 'store']);
    Route::get('/akun/edit/{id}', [UserController::class, 'edit']);
    Route::post('/akun/update', [UserController::class, 'update']);
    Route::get('/akun/hapus/{id}', [UserController::class, 'destroy']);
});

require __DIR__.'/auth.php';
