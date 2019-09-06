<?php

use Illuminate\Http\Request;


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
 
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
 
    Route::get('user', 'ApiController@getAuthUser');
 
    Route::get('restaurants', 'RestaurantController@index');
    Route::get('restaurants/{id}', 'RestaurantController@show');
    Route::post('restaurants', 'RestaurantController@store');
    Route::put('restaurants/{id}', 'RestaurantController@update');
    Route::delete('restaurants/{id}', 'RestaurantController@destroy');
});