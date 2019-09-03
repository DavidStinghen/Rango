<?php

use Illuminate\Http\Request;


Route::post('/register', 'Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('restaurants', 'RestaurantController@index');
    Route::get('restaurants/{restaurant}', 'RestaurantController@show');
    Route::post('restaurants', 'RestaurantController@store');
    Route::put('restaurants/{restaurant}', 'RestaurantController@update');
    Route::delete('restaurants/{restaurant}', 'RestaurantController@delete');
});