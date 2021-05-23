<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/posts')->group(function() {
    Route::get('/', 'PostsController@index');
    Route::get('/{id}', 'PostsController@show');
});

Route::prefix('/auth')->group(function () {
    Route::post('/login', 'AuthController@login');
});
