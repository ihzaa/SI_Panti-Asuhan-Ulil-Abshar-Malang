<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'frontend\HomeController@index')->name('home');
Route::get('home', 'frontend\HomeController@index')->name('home');
Route::get('profil_anak', 'frontend\ProfilAnakController@index')->name('profil_anak');
Route::get('profil_anak/pagination', 'frontend\ProfilAnakController@fetch_data')->name('profil_anak_pagination');

Route::post('donasi', 'frontend\HomeController@donation')->name('send_donasi');


Route::prefix('adm1n')->middleware('auth:admin')->group(function () {
  // Donasi
  Route::get('donasi', 'Admin\DonationController@index')->name('admin_pages_donasi_index');
  Route::get('donasi_masuk', 'Admin\DonationController@donasi_masuk')->name('admin_pages_donasi_masuk');
  Route::get('donasi/konfirmasi/{id}', 'Admin\DonationController@confirmation')->name('admin_donasi_konfirmasi');
  Route::get('donasi/konfirmasi/batal/{id}', 'Admin\DonationController@cancel_confirmation')->name('admin_donasi_konfirmasi_cancel');
  Route::get('donasi/delete/{id}', 'Admin\DonationController@delete')->name('admin_hapus_donasi');

  // CRUD Profil Anak
  Route::get('profil_anak', 'Admin\ProfilAnakController@index')->name('admin_profil_anak');
  Route::post('profil_anak/create', 'Admin\ProfilAnakController@store')->name('admin_profil_anak_create');
  Route::get('profil_anak/edit/{id}', 'Admin\ProfilAnakController@edit')->name('admin_profil_anak_edit');
  Route::post('profil_anak/update', 'Admin\ProfilAnakController@update')->name('admin_profil_anak_update');
  Route::get('profil_anak/delete/{id}', 'Admin\ProfilAnakController@delete')->name('admin_profil_anak_delete');
});
