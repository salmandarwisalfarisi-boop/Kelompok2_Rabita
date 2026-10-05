<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/beranda', function () {
    return view('beranda');
})->middleware(['auth'])->name('beranda');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

Route::resource('produk', App\Http\Controllers\ProdukController::class)
    ->middleware(['auth', 'admin']);


require __DIR__.'/auth.php';

