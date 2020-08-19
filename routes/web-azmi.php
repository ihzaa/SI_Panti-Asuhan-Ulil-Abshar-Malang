<?php

use Illuminate\Support\Facades\Route;

Route::get('/produk', 'frontend\ProdukController@index')->name('produk');
Route::get('/produk/{id}', 'frontend\ProdukController@produk_detail')->name('produk_detail');


Route::prefix('adm1n')->middleware('auth:admin')->group(function () {

    Route::get('produk', 'Admin\ProdukController@index')->name('admin_produk');
    Route::get('produk/tambah', 'Admin\produkController@HalamanTambah')->name('admin_tampil_halaman_tambah_produk');
    Route::post('produk/tambah', 'Admin\produkController@create')->name('admin_tambah_produk');
    Route::get('produk/delete/{id}', 'Admin\produkController@destroy')->name('admin_hapus_produk');
    Route::get('produk/edit/{id}', 'Admin\produkController@tampilEditProduk')->name('admin_tampil_edit_produk');
    Route::post('produk/edit/{id}', 'Admin\produkController@edit')->name('admin_edit_produk');
    Route::get('produk/gambar/{id}', 'Admin\produkController@tampilgambarProduk')->name('admin_gambar_produk');
    Route::post('produk/gambar/{id}', 'Admin\produkController@tambahgambar')->name('admin_tambah_gambar_produk');
    Route::get('produk/hapus/{id}', 'Admin\produkController@hapusGambar')->name('admin_hapus_gambar');
    
  
  });