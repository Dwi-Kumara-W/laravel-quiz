<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;


Route::prefix('barang')->name('barang.')->group(function(){
    Route::get('/', [BarangController::class, 'index'])->name('index');
    Route::get('tambah', [BarangController::class, 'tambah'])->name('tambah');
    Route::get('edit/{id_barang}', [BarangController::class, 'edit'])->name('edit');
    Route::post('send', [BarangController::class, 'store'])->name('send');
    Route::post('postubah', [BarangController::class, 'update'])->name('postubah');
    Route::get('cari',[BarangController::class, 'cari'])->name('cari');
    Route::get('hapus/{id_barang}', [BarangController::class, 'destroy'])->name('hapus');
    // Route::get('checkout/{id_barang}', [KeranjangController::class, 'edit'])->name('checkout');
});

Route::prefix('order')->name('order.')->group(function(){

    Route::get('/', [KeranjangController::class, 'index'])->name('index');
    Route::get('cari',[KeranjangController::class, 'cari'])->name('cari');
    Route::get('checkout/{id_barang}', [KeranjangController::class, 'edit'])->name('checkout');
    Route::post('tambah', [KeranjangController::class, 'store'])->name('tambah');

});

Route::prefix('customer')->name('customer.')->group(function(){

    Route::get('/', [KeranjangController::class, 'index_keranjang'])->name('index');
    Route::get('detailcustomer/{id_keranjang}', [KeranjangController::class, 'edit_status'])->name('detailcustomer');
    Route::post('status', [KeranjangController::class, 'update_status'])->name('status');

});

Route::prefix('laporan')->name('laporan.')->group(function(){

    Route::get('/', [KeranjangController::class, 'index_laporan'])->name('index');
    Route::get('detail_laporan/{id_keranjang}', [KeranjangController::class, 'index_detail_laporan'])->name('detail_laporan');

});

// Route::get('/coba', function () {
//     return view('coba');
// });
