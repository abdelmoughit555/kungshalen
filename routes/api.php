<?php

Route::middleware('auth:airlock')->get('/user', function() {
    return request()->user();
});

Route::get('/shop', 'ShopController');

Route::apiResources([
    'products' => 'ProductController',
    'categories' => 'CategoryController',
    'countries' => 'CountryController',
    'visitors' => 'VisitorController'
]);
