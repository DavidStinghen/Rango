<?php

use Illuminate\Http\Request;


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
 
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
 
    Route::get('user', 'ApiController@getAuthUser');
 
    Route::get('restaurants', 'ProductController@index');
    Route::get('restaurants/{id}', 'ProductController@show');
    Route::post('restaurants', 'ProductController@store');
    Route::put('restaurants/{id}', 'ProductController@update');
    Route::delete('restaurants/{id}', 'ProductController@destroy');
});