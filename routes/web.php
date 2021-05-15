<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin');
Route::prefix('/oauth')->group(function () {
    Route::get('/', 'AuthController@oauthRedirect');
    Route::get('/callback', 'AuthController@handleOauth');
});

Route::prefix('/articoli')->group(function() {
    Route::get('/', 'PostsController@index')->name('posts');
    Route::get('/{slug}', 'PostsController@show')->name('posts::show');
    Route::post('/{slug}/comment', 'PostsController@comment')->middleware(['auth', 'role:user'])->name('posts::comment');
});
