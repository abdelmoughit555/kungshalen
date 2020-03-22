<?php

Route::middleware('auth:airlock')->get('/user', function() {
    return request()->user();
});

Route::get('/shop', 'ShopController');

//Cart
Route::get('/cart', 'CartController@index');
Route::post('/cart/{product}', 'CartController@store');
Route::put('/cart', 'CartController@update');
Route::delete('/cart', 'CartController@destroy');

Route::apiResources([
    'products' => 'ProductController',
    'categories' => 'CategoryController',
    'countries' => 'CountryController',
    'visitors' => 'VisitorController',
]);
