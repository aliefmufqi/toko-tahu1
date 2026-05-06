<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ResepController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminResepController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\NotifikasiController;

// =================== PUBLIK ===================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');
Route::get('/resep/{slug}', [ResepController::class, 'show'])->name('resep.show');

// =================== CUSTOMER ===================
Route::middleware(['auth'])->group(function () {
    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::patch('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    // Pesanan
    Route::get('/checkout', [PesananController::class, 'checkout'])->name('checkout');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{kode}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{kode}/bayar', [PesananController::class, 'bayar'])->name('pesanan.bayar');
});

// =================== ADMIN ===================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::resource('produk', AdminProdukController::class);

    // Pesanan
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::patch('/pesanan/{id}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.status');
    Route::patch('/pesanan/{id}/konfirmasi-bayar', [AdminPesananController::class, 'konfirmasiBayar'])->name('pesanan.konfirmasi');

    // Kategori
    Route::resource('kategori', AdminKategoriController::class);

    // User
    Route::resource('user', AdminUserController::class);

    // Resep
    Route::resource('resep', AdminResepController::class);

    // Setting
    Route::get('/setting', [AdminSettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [AdminSettingController::class, 'update'])->name('setting.update');

    // Notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'tandaiBaca'])->name('notifikasi.baca');
    Route::post('/notifikasi/baca/{id}', [NotifikasiController::class, 'tandaiBacaSatu'])->name('notifikasi.baca.satu');
    Route::delete('/notifikasi/hapus', [NotifikasiController::class, 'hapusSemua'])->name('notifikasi.hapus');
});

Auth::routes();