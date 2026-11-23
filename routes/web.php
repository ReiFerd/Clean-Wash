<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganOnlyController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\StatusCekController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

// Public page
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Fitur Khusus Pelanggan Login
Route::middleware(['cek.role:pelanggan'])->group(function () {
    Route::get('/status-saya', [PelangganOnlyController::class, 'status'])->name('pelanggan.status');
    Route::get('/pesan-laundry', [PelangganOnlyController::class, 'createPemesanan'])->name('pelanggan.pemesanan.create');
    Route::post('/pesan-laundry', [PelangganOnlyController::class, 'storePemesanan'])->name('pelanggan.pemesanan.store');
    Route::get('/riwayat-saya', [PelangganOnlyController::class, 'riwayat'])->name('pelanggan.riwayat');
    Route::get('/profil-saya', [PelangganOnlyController::class, 'profil'])->name('pelanggan.profil');
});

// VVVVVVV Fitur Admin VVVVVVV
Route::middleware(['cek.role:admin'])->group(function () {
    // Fitur CRUD Pelanggan (May)
    Route::resource('pelanggan', PelangganController::class);

    // Fitur Status & Tracking Laundry (Reyhan)
    Route::get('/status', [StatusController::class, 'index'])->name('status.index');
    Route::put('/status/{id_transaksi?}', [StatusController::class, 'update'])->name('status.update');
    Route::get('/status-cek/{id?}', [StatusCekController::class, 'index'])->name('status.cek');

    // Fitur Laporan Pendapatan dan Transaksi (Arya)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Fitur CRUD Pemesanan Laundry (Kirana)
    Route::resource('pemesanan', PemesananController::class);
});
