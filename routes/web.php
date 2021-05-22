<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin');
Route::prefix('/oauth')->group(function () {
    Route::get('/', 'AuthController@oauthRedirect')->name('oauth::login');
    Route::get('/callback', 'AuthController@handleOauth');
});

Route::post('/quote', 'QuotesController@store')->name('quotes');

Route::prefix('/articoli')->group(function() {
    Route::get('/', 'PostsController@index')->name('posts');
    Route::get('/{slug}', 'PostsController@show')->name('posts::show');
    Route::post('/{slug}/comment', 'PostsController@comment')->middleware(['auth', 'role:user'])->name('posts::comment');
});

Route::group(['prefix' => '/settings', 'middleware' => 'auth'], function () {
    Route::get('/', 'SettingsController@index')->name('settings');
    Route::get('/delete', 'SettingsController@delete')->name('settings::delete');
    Route::post('/delete', 'SettingsController@confirmDelete');
});
