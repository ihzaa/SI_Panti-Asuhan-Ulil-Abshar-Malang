<?php

use Illuminate\Support\Facades\Route;

Route::get('/produk', 'frontend\ProdukController@index')->name('produk');
Route::get('/produk/{id}', 'frontend\ProdukController@produk_detail')->name('produk_detail');

Route::get('all/pengeluaran/get/tahun', 'frontend\PengeluaranController@getAllYear')->name('all_user_get_tahun_Pengeluaran');
Route::get('all/pengeluaran/get/month/{year}', 'frontend\PengeluaranController@getAllMonthByYear')->name('all_user_get_bulan_Pengeluaran_per_tahun');
Route::get('all/pengeluaran/download/tahun/{year}', 'frontend\PengeluaranController@downloadPengeluaranByYear')->name('all_user_downlaod_Pengeluaran_tahun');
Route::get('all/pengeluaran/download/bulan/{month}/{year}', 'frontend\PengeluaranController@downloadPengeluaranByMonth')->name('all_user_downlaod_Pengeluaran_bulan');

//test aja ini
Route::get('cek/pengeluaran/download/tahun/{year}', 'frontend\PengeluaranController@cek')->name('cek_downlaod_Pengeluaran_tahun');

Route::get('cek/pengeluaran/download/bulan/{month}/{year}', 'frontend\PengeluaranController@cekb')->name('cek_downlaod_Pengeluaran_bulan');



Route::prefix('adm1n')->middleware('auth:admin')->group(function () {

  Route::get('produk', 'Admin\ProdukController@index')->name('admin_produk');
  Route::get('produk/tambah', 'Admin\ProdukController@HalamanTambah')->name('admin_tampil_halaman_tambah_produk');
  Route::post('produk/tambah', 'Admin\ProdukController@create')->name('admin_tambah_produk');
  Route::get('produk/delete/{id}', 'Admin\ProdukController@destroy')->name('admin_hapus_produk');
  Route::get('produk/edit/{id}', 'Admin\ProdukController@tampilEditProduk')->name('admin_tampil_edit_produk');
  Route::post('produk/edit/{id}', 'Admin\ProdukController@edit')->name('admin_edit_produk');
  Route::get('produk/gambar/{id}', 'Admin\ProdukController@tampilgambarProduk')->name('admin_gambar_produk');
  Route::post('produk/gambar/{id}', 'Admin\ProdukController@tambahgambar')->name('admin_tambah_gambar_produk');
  Route::get('produk/hapus/{id}', 'Admin\ProdukController@hapusGambar')->name('admin_hapus_gambar');

  Route::get('pengeluaran', 'Admin\PengeluaranController@index')->name('admin_pengeluaran');
  Route::get('pengeluaran/tambah', 'Admin\PengeluaranController@HalamanTambah')->name('admin_tampil_halaman_tambah_pengeluaran');
  Route::post('pengeluaran/tambah', 'Admin\PengeluaranController@create')->name('admin_tambah_pengeluaran');
  Route::get('pengeluaran/delete/{id}', 'Admin\PengeluaranController@destroy')->name('admin_hapus_pengeluaran');
  Route::get('pengeluaran/edit/{id}', 'Admin\PengeluaranController@tampilEdit')->name('admin_tampil_edit_pengeluaran');
  Route::post('pengeluaran/edit/{id}', 'Admin\PengeluaranController@edit')->name('admin_edit_pengeluaran');
});
