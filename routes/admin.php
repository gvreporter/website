<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@home');
Route::get('/logout', 'DashboardController@logout')->name('logout');
