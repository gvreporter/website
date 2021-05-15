<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@home')->name('dash');

Route::prefix('/posts')->group(function() {
    Route::get('/new', 'PostsController@create')->name('posts::new');
    Route::post('/new', 'PostsController@store');

    Route::get('/{slug}/image', 'PostsController@showImage')->name('posts::image');
});
