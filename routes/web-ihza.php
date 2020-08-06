<?php

use Illuminate\Support\Facades\Route;

Route::get('/blog', 'frontend\BlogController@index')->name('frontend_blog_index');
Route::get('/blog/cari/{cari}', 'frontend\BlogController@cari')->name('frontend_blog_cari');
Route::get('/blog/kategori/{kat}', 'frontend\BlogController@kategori')->name('frontend_blog_per_kategori');
Route::get('/blog/{id}', 'frontend\BlogController@single_blog')->name('frontend_single_blog');

Route::get('/contact', 'frontend\ContactController@index')->name('frontend_contact');

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
    Route::get('pages/blog/tambah', 'Admin\BlogController@tampilHalamanTambah')->name('admin_tampil_halaman_tambah_blog');
    Route::post('pages/blog/tambah', 'Admin\BlogController@tambahBlog')->name('admin_tambah_blog');
    Route::get('pages/blog/edit/{id}', 'Admin\BlogController@editBlogIndex')->name('admin_edit_blog_index');
    Route::post('pages/blog/edit/{id}', 'Admin\BlogController@editBlog')->name('admin_edit_blog');

    // Route::post('pages/blog/kategori/index/tambah','')->name('admin_tambah_blog_kategori_index');
    Route::post('pages/blog/kategori/tambah', 'Admin\BlogController@tambahKategori')->name('admin_tambah_blog_kategori');
    Route::get('kategori/all', 'Admin\BlogController@getAllKategori')->name('admin_get_all_kategori');
    Route::get('kategori/hapus/{id}', 'Admin\BlogController@hapusKategori')->name('admin_hapus_blog_kategori');
    Route::post('kategori/edit/{id}', 'Admin\BlogController@editKategori')->name('admin_edit_blog_kategori');
});
