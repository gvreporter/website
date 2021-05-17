<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@home')->name('dash');

Route::prefix('/posts')->group(function() {
    Route::get('/new', 'PostsController@create')->name('posts::new');
    Route::post('/new', 'PostsController@store');

    Route::get('/{slug}/image', 'PostsController@showImage')->name('posts::image');
});

Route::group(['prefix' => '/users', 'middleware' => 'role:admin'], function () {
    Route::get('/', 'UsersController@index')->name('users');
    Route::get('/new', 'UsersController@create')->name('users::new');
    Route::post('/new', 'UsersController@store');
    Route::get('/{user}/edit', 'UsersController@edit')->name('users::edit');
    Route::post('/{user}/edit', 'UsersController@update');
});

Route::prefix('/quotes')->group(function () {
    Route::get('/{id}/approve', 'QuotesController@approve')->name('quotes::approve');
    Route::get('/{id}/remove', 'QuotesController@remove')->name('quotes::remove');
});
