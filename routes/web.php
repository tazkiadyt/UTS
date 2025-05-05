<?php

use App\Http\Controllers\ErrorController;
<<<<<<< HEAD
use App\Http\Controllers\laporanController;
use App\Http\Controllers\PembayaranController;
=======
>>>>>>> 1f555367fdc494c87f507ad34a30bceb9fcff838
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
<<<<<<< HEAD
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('laporan', laporanController::class);
=======
>>>>>>> 1f555367fdc494c87f507ad34a30bceb9fcff838
});

require __DIR__.'/auth.php';
