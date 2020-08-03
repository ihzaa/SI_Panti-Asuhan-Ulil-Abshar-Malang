<?php

use Illuminate\Support\Facades\Route;

Route::get('/about', function () {
    return view('frontend.pages.about');
})->name('admin_dashboard');