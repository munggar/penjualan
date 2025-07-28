<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CicilanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

// Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::get('/produk/{id}/tambah', [ProdukController::class, 'tambah'])->name('produk.tambah');
// Route::put('/produk/{id}', [ProdukController::class, 'updateStok'])->name('produk.updateStok');
// use App\Http\Controllers\ProdukController;

Route::put('/produk/{id}/tambah-stok', [ProdukController::class, 'updateStok'])->name('produk.updateStok');

Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

// Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [LaporanController::class, 'cetakPDF'])->name('laporan.cetak');

// Transaksi
// Route::resource('transaksi', TransaksiController::class);
// Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
// Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
// Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// --- Transaksi utama ---
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::delete('/transaksi/{id}', [transaksiController::class, 'destroy'])->name('transaksi.destroy');

// --- Cicilan (jika metode cicilan dipakai) ---
Route::get('/transaksi/{id}/cicilan', [CicilanController::class, 'create'])->name('cicilan.create');
Route::post('/transaksi/{id}/cicilan', [CicilanController::class, 'store'])->name('cicilan.store');

// Cetak Nota
Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakNota'])->name('transaksi.cetak');
Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'nota'])->name('transaksi.nota');

// Cicilan
// Route::post('/cicilan', [CicilanController::class, 'store'])->name('cicilan.store');

