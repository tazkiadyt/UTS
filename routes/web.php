<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\PembayaranController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TempatAcaraController;
use App\Http\Controllers\TiketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('error', ErrorController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tiket', TiketController::class);
    Route::resource('tempat_acara', TempatAcaraController::class);
    Route::resource('reservasi', ReservasiController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('laporan', laporanController::class);
});

require __DIR__.'/auth.php';
