<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BlogPublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes - Publik (User)
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Tentang Kami
Route::view('/tentang', 'tentang')->name('tentang');

// Katalog Produk & Kategori
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');

// Detail Produk
Route::get('/detail/{id}', [DetailController::class, 'show'])->name('detail');

// Keranjang Belanja
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'add'])->name('keranjang.add');
Route::post('/keranjang/update', [KeranjangController::class, 'update'])->name('keranjang.update');
Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

// Checkout & Pemesanan
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// RajaOngkir Real-Time API
Route::get('/rajaongkir/destination', [CheckoutController::class, 'getDestinations'])->name('rajaongkir.destination');
Route::post('/rajaongkir/cost', [CheckoutController::class, 'calculateCost'])->name('rajaongkir.cost');

// Riwayat & Detail Pesanan User (Wajib Login)
Route::middleware('auth')->group(function () {
    Route::get('/pesanan-saya', [CheckoutController::class, 'riwayatPesanan'])->name('pesanan.user.index');
    Route::get('/pesanan-saya/{id}', [CheckoutController::class, 'detailPesanan'])->name('pesanan.user.show');
    Route::post('/pesanan-saya/{id}/upload-bukti', [CheckoutController::class, 'uploadBukti'])->name('pesanan.user.upload-bukti');
});

// Blog Publik
Route::get('/blogs', [BlogPublicController::class, 'index'])->name('blog.public');
Route::get('/blogs/{id}', [BlogPublicController::class, 'show'])->name('blog.show.public');

/*
|--------------------------------------------------------------------------
| Web Routes - Backoffice (Admin dengan Middleware Auth & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Settings (Pengaturan)
    Route::get('/admin/pengaturan', [DashboardController::class, 'showPengaturan'])->name('admin.pengaturan');
    Route::post('/admin/pengaturan', [DashboardController::class, 'updatePengaturan'])->name('admin.pengaturan.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/realtime', [DashboardController::class, 'realtimeStats'])->name('dashboard.realtime');

    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);

    Route::post('pesanan/{pesanan}/konfirmasi', [PesananController::class, 'konfirmasi'])->name('pesanan.konfirmasi');
    Route::put('pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::resource('pesanan', PesananController::class)->only(['index', 'show', 'destroy']);

    Route::resource('pengguna', PenggunaController::class);
    Route::resource('blog', BlogController::class);
});

require __DIR__.'/auth.php';
