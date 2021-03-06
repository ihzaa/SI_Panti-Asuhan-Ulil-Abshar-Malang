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

Route::get('all/donasi/get/tahun', 'frontend\DonasiController@getAllYear')->name('all_user_get_tahun_donasi');
Route::get('all/donasi/get/month/{year}', 'frontend\DonasiController@getAllMonthByYear')->name('all_user_get_bulan_donasi_per_tahun');
Route::get('all/donasi/download/tahun/{year}', 'frontend\DonasiController@downloadDonasiByYear')->name('all_user_downlaod_donasi_tahun');
Route::get('all/donasi/download/bulan/{month}/{year}', 'frontend\DonasiController@downloadDonasiByMonth')->name('all_user_downlaod_donasi_bulan');

//test aja ini
// Route::get('cek/donasi/download/tahun/{year}', 'frontend\DonasiController@cek')->name('cek_downlaod_donasi_tahun');
// Route::get('cek/donasi/download/bulan/{month}/{year}', 'frontend\DonasiController@cekb')->name('cek_downlaod_donasi_bulan');


//INI CONTOH ROUTE DGN MIDDLEWARE ADMIN
//JADI ROUTE2 DIBAWAH HARUS LOGIN DULU SEBAGAI ADMIN BARU BISA DIBUKA
//PREFIX admin BERARTI NANTI URLNYA BERAWALAN /adm1n/, MISAL: domain.com/adm1n/.....
//MIDDLEWARE YG DIPAKE AUTH:ADMIN
Route::prefix('adm1n')->middleware('auth:admin')->group(function () {
    Route::get('/testing', 'Admin\DonationController@testing');
    Route::get('', 'Admin\DashboardController@index')->name('admin_dashboard');

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

    Route::get('kelola-akun', 'Admin\AkunController@index')->name('admin_kelola_akun');
    Route::post('ubah-pass', 'Admin\AkunController@ubahPass')->name('admin_ubah_password');
    Route::post('ubah-nama', 'Admin\AkunController@ubahNama')->name('admin_ubah_nama');

    Route::post('setting/nomer', 'Admin\SettingController@aturNomerWa')->name('admin_setting_nomer_wa');
    Route::post('setting/apikey', 'Admin\SettingController@aturApiKey')->name('admin_setting_api_key');
    Route::get('setting/get_nomer_wa_key', 'Admin\SettingController@getDataAdmin')->name('admin_setting_get_data');

    Route::get('donasi/download/tahun/{year}', 'frontend\DonasiController@downloadDonasiByYear')->name('admin_downlaod_donasi_tahun');
    Route::get('donasi/download/bulan/{month}/{year}', 'frontend\DonasiController@downloadDonasiByMonth')->name('admin_downlaod_donasi_bulan');

    Route::get('pengeluaran/get/all', 'Admin\PengeluaranController@getAll')->name('admin_get_all_pengeluaran_dong');
    Route::post('pengeluaran/tambah', 'Admin\PengeluaranController@tambah')->name('admin_tambah_pengeluaran_dong');
    Route::post('pengeluaran/edit', 'Admin\PengeluaranController@edit_dong')->name('admin_edit_pengeluaran_dong');
    Route::get('pengeluaran/hapus/{id}', 'Admin\PengeluaranController@hapus_dong')->name('admin_hapus_pengeluaran_dong');
});
