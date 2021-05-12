<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin');
