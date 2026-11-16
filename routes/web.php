<?php

use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::put('/status/{id_transaksi?}', [StatusController::class, 'update'])->name('status.update');
