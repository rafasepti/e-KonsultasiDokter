<?php

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
});

require __DIR__.'/auth.php';
