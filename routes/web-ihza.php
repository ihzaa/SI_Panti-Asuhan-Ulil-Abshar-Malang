<?php

use Illuminate\Support\Facades\Route;

Route::get('/blog', 'frontend\BlogController@index')->name('frontend_blog_index');
Route::get('/blog/{id}', 'frontend\BlogController@single_blog')->name('frontend_single_blog');

Route::get('/adm1n/login', 'Auth\AdminLoginController@loginGet')->name('login_admin_get')->middleware('guest');
Route::post('/adm1n/login', 'Auth\AdminLoginController@loginPost')->name('login_admin_post')->middleware('guest');
Route::get('/adm1n/logout', 'Auth\AdminLoginController@logout')->name('logout_admin');


//INI CONTOH ROUTE DGN MIDDLEWARE ADMIN
//JADI ROUTE2 DIBAWAH HARUS LOGIN DULU SEBAGAI ADMIN BARU BISA DIBUKA
//PREFIX admin BERARTI NANTI URLNYA BERAWALAN /adm1n/, MISAL: domain.com/adm1n/.....
//MIDDLEWARE YG DIPAKE AUTH:ADMIN
Route::prefix('adm1n')->middleware('auth:admin')->group(function () {

    Route::get('', function () {
        return view('admin.pages.dashboard');
    })->name('admin_dashboard');

    Route::get('pages/blog', 'Admin\BlogController@index')->name('admin_pages_blog_index');
    Route::get('pages/blog/delete/{id}', 'Admin\BlogController@hapus')->name('admin_hapus_blog');
    Route::get('pages/blog/tambah','Admin\BlogController@tampilHalamanTambah')->name('admin_tampil_halaman_tambah_blog');

});
