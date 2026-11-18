<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatusCekController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Fitur Auth
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Fitur CRUD Pelanggan (May)
Route::resource('pelanggan', PelangganController::class);

// Fitur Status & Tracking Laundry (Reyhan)
Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::put('/status/{id_transaksi?}', [StatusController::class, 'update'])->name('status.update');
Route::get('/status/{id?}', [StatusCekController::class, 'index'])->name('status.cek');

// Fitur Laporan Pendapatan dan Transaksi (Arya)
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/status-cek/{id?}', [StatusCekController::class, 'index'])->name('status.index');
