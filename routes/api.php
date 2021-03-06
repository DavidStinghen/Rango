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

    Route::post('products', 'ProductController@store');
    Route::put('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');

    Route::get('menus', 'MenuController@index');
    Route::get('menus/{id}', 'MenuController@show');
    Route::post('menus', 'MenuController@store');
    Route::put('menus/{id}', 'MenuController@update');
    Route::delete('menus/{id}', 'MenuController@destroy');

    Route::post('registration', 'RegistrationController@store');
    Route::delete('registration/{id}', 'RegistrationController@destroy');

});