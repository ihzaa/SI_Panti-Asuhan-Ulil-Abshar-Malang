<?php

use Illuminate\Support\Facades\Route;

Route::get('/about', 'frontend\AboutController@index')->name('about');
