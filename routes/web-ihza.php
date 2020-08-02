<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.pages.dashboard');
})->name('admin_dashboard');

Route::get('/blog', 'frontend\BlogController@index')->name('frontend_blog_index');
