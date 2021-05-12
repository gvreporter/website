<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@home')->name('dash');
Route::get('/logout', 'DashboardController@logout')->name('logout');

Route::prefix('/posts')->group(function() {
    Route::get('/new', 'PostsController@create')->name('posts::new');
    Route::post('/new', 'PostsController@store');
});