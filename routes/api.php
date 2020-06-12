<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

JsonApi::register('default')->routes(static function ($api) {
    Route::namespace('Api')->group(static function () {
        Route::post('/register', 'RegisterController')->withoutMiddleware('auth:api');
        Route::post('/login', 'LoginController')->withoutMiddleware('auth:api');
        Route::post('/logout', 'LogoutController');

        Route::group(['namespace' => 'V1', 'middleware' => 'client'], static function () {
            Route::get('/user', 'UserController');
        });
    });

    $api->resource('product_types')->relationships(static function ($relations) {
        $relations->hasMany('products');
    });
    $api->resource('products')->relationships(static function ($relations) {
        $relations->hasOne('product_types');
    });
});
