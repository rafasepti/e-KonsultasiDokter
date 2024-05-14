<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PercakapanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileRSController;
use App\Http\Controllers\SpesialisasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\vendor\Chatify\MessagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'pengguna'])->name('index');

Route::get('/profile-rs/pengguna', [ProfileRSController::class, 'pengguna'])->name('profile-rs.pengguna');
Route::get('/contact-rs/pengguna', [ProfileRSController::class, 'contact'])->name('contact-rs.pengguna');
Route::post('/contact-rs/send', [ProfileRSController::class, 'send'])->name('contact-rs.send');
Route::get('/tes', [IndexController::class, 'sendData'])->name('contact-rs.send');

Route::get('/chat-rs', [PercakapanController::class, 'index'])->name('chat-rs');
Route::get('/chat-rs/{id}', [PercakapanController::class, 'spesialisasi'])->name('chat-rs.spesialisasi');

Route::middleware('auth', 'checkRole:pasien')->group(function () {
    Route::get('/chat-rs/order/{id}', [PercakapanController::class, 'order'])->name('chat-rs.order');
    Route::get('/chat-rs/store', [PercakapanController::class, 'store'])->name('chat-rs.store');
    
    
    Route::get('/pembayaran/status-bayar', [OrderController::class, 'viewStatus'])->name('pembayaran.view-status');
    Route::get('/chat-dokter', [PercakapanController::class, 'chat'])->name('chat-dokter');

    Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');

    Route::get('/midtrans', [MidtransController::class, 'index'])->name('midtrans.index');
    Route::get('/midtrans/status', [MidtransController::class, 'cekStatus'])->name('midtrans.cek-status');
    Route::get('/midtrans/tes/{id}', [MidtransController::class, 'tes'])->name('midtrans.tes');
    Route::get('/midtrans/bayar', [MidtransController::class, 'bayar'])->name('midtrans.bayar');
    Route::post('/midtrans/proses_bayar', [MidtransController::class, 'prosesBayar'])->name('midtrans.proses-bayar');
});

Route::middleware('auth', 'checkRole:dokter')->group(function () {
    Route::get('/status-chat', [OrderController::class, 'viewStatus'])->name('pembayaran.view-status');
    Route::get('/status-chat/list', [OrderController::class, 'statusGet']);
    Route::get('/status-chat/konfirmasi/{id}', [OrderController::class, 'update']);

    Route::post('/ChatDokter/endedConversation', [MessagesController::class, 'endedConversation']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'checkRole:admin')->group(function () {
    Route::get('/admin', function () {return view('admin/v_admin');})->name('index.admin');

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

    Route::get('/profile-rs', [ProfileRSController::class, 'index'])->name('profile-rs');
    Route::post('/profile-rs/store', [ProfileRSController::class, 'store']);
    Route::post('/profile-rs/update', [ProfileRSController::class, 'update']);
});

require __DIR__.'/auth.php';
