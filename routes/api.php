<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/posts')->group(function() {
    Route::get('/', 'PostsController@index');
});
