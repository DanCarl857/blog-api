<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return 'welcome to our blog';
})

Route::middleware('auth:api')->group( function () {
    Route::post('storeBlog', 'API\PostController@store');
    Route::get('blogs', 'API\PostController@index');
    Route::put('updateBlog/{id}', 'API\PostController@update');
    Route::get('showBlog/{id}', 'API\PostController@show');
    Route::delete('deleteBlog/{id}', 'API\PostController@destroy');
});
