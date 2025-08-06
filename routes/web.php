<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CicilanController;

// Cek koneksi DB
Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return '✅ Connected to PostgreSQL!';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});

// Auth (login/logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::get('/produk/{id}/tambah', [ProdukController::class, 'tambah'])->name('produk.tambah');
    Route::put('/produk/{id}/tambah-stok', [ProdukController::class, 'updateStok'])->name('produk.updateStok');
    Route::post('/produk/{id}/save', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetakPDF'])->name('laporan.cetak');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    // Cicilan
    Route::get('/transaksi/{id}/cicilan', [CicilanController::class, 'create'])->name('cicilan.create');
    Route::post('/transaksi/{id}/cicilan', [CicilanController::class, 'store'])->name('cicilan.store');

    // Cetak Nota
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakNota'])->name('transaksi.cetak');
    Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'nota'])->name('transaksi.nota');

    // Cost
    Route::resource('cost', 'App\Http\Controllers\HomeController')->only(['index', 'store', 'edit', 'update', 'destroy', 'create']);

    //report
    Route::get('/report', [LaporanController::class, 'exportPDF'])->name('report');
});
