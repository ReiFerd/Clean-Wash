<?php

use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('pelanggan', PelangganController::class);
Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::put('/status/{id_transaksi?}', [StatusController::class, 'update'])->name('status.update');
Route::get('/status/{id?}', [StatusCekController::class, 'index'])->name('status.index');
