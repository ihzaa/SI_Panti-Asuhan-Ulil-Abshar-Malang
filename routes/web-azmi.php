<?php

use Illuminate\Support\Facades\Route;

Route::get('/produk', 'frontend\ProdukController@index')->name('produk');

Route::prefix('adm1n')->middleware('auth:admin')->group(function () {

    Route::get('produk', 'Admin\ProdukController@index')->name('admin_produk');
    Route::get('produk/tambah', 'Admin\produkController@HalamanTambah')->name('admin_tampil_halaman_tambah_produk');
    Route::post('produk/tambah', 'Admin\produkController@create')->name('admin_tambah_produk');
    Route::get('produk/delete/{id}', 'Admin\produkController@destroy')->name('admin_hapus_produk');
    Route::get('produk/edit/{id}', 'Admin\produkController@tampilEditProduk')->name('admin_tampil_edit_produk');
    Route::post('produk/edit/{id}', 'Admin\produkController@edit')->name('admin_edit_produk');
    
  
  });