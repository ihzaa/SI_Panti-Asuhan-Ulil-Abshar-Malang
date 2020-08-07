<?php

use Illuminate\Support\Facades\Route;

Route::get('/about', 'frontend\AboutController@index')->name('about');

Route::prefix('adm1n')->middleware('auth:admin')->group(function () {

  Route::get('manager', 'Admin\ManagerController@index')->name('admin_manager');
  Route::get('manager/tambah', 'Admin\ManagerController@tampilHalamanTambah')->name('admin_tampil_halaman_tambah_pengurus');
  Route::post('manager/tambah', 'Admin\ManagerController@tambahData')->name('admin_tambah_pengurus');
  Route::get('manager/delete/{id}', 'Admin\ManagerController@hapus')->name('admin_hapus_pengurus');
  Route::get('manager/edit/{id}', 'Admin\ManagerController@tampilEditPengurus')->name('admin_tampil_edit_pengurus');
  Route::post('manager/edit/{id}', 'Admin\ManagerController@editBlog')->name('admin_edit_pengurus');

});