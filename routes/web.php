<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukBibitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BibitController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::middleware('preventBack' )->group(function () {

    Route::post('/', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes
Route::middleware('preventBack' )->group(function () {


    route::middleware('auth')->group(function () {
        



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard/chart', action: [DashboardController::class, 'getChartAjax']);
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Bahan Baku Routes
    Route::resource('bahan-baku', BahanBakuController::class);

    // Bibit Routes
    Route::resource('bibit', BibitController::class);

    // Stok Routes
    Route::resource('stok_bibit', StokController::class);

    // Tambahkan route khusus
    Route::post('stok_bibit/{stokBibit}/add-masuk', [StokController::class, 'addStokMasuk'])
        ->name('stok_bibit.add-masuk');

    Route::post('stok_bibit/{stokBibit}/add-keluar', [StokController::class, 'addStokKeluar'])
        ->name('stok_bibit.add-keluar');

    // Tambahan route untuk stok masuk dan keluar
    Route::post('/stok-bibit/{id}/masuk', [StokController::class, 'addStokMasuk'])->name('stok_bibit.masuk');
    Route::post('/stok-bibit/{id}/keluar', [StokController::class, 'addStokKeluar'])->name('stok_bibit.keluar');




    // Toko Routes
    Route::resource('toko', TokoController::class);
    Route::resource('produk-bibit', ProdukBibitController::class);

    });
});
