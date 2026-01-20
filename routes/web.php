<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendakiController;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\JadwalpendakianController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailpendakiController;
use App\Http\Controllers\PenjualantiketController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/pemesanan/create', [PemesananController::class, 'create'])
    ->name('pemesanan.create');

Route::post('/pemesanan', [PemesananController::class, 'store'])
    ->name('pemesanan.store');

Route::get('/persyaratan-pendaki', function () {
    return view('informasi.persyaratan');
})->name('persyaratan');

Route::get('/perlengkapan', function () {
    return view('perlengkapan');
})->name('perlengkapan');

Route::get('/jalur-pendakian', function () {
    return view('jalur.index');
})->name('jalur');





/*
|--------------------------------------------------------------------------
| MASTER DATA
|--------------------------------------------------------------------------
*/

// Pendaki
Route::resource('pendaki', PendakiController::class);

// Gunung
Route::resource('gunung', GunungController::class);

// Jadwal Pendakian
Route::resource('jadwalpendakian', JadwalpendakianController::class);

// Pemesanan
Route::resource('pemesanan', PemesananController::class);

// Detail Pendaki
Route::resource('detailpendaki', DetailpendakiController::class);

// Penjualan Tiket
Route::resource('penjualantiket', PenjualantiketController::class);


