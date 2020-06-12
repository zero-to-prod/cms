<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

JsonApi::register('default')->routes(static function ($api) {
    $api->resource('product_types')->relationships(static function ($relations) {
        $relations->hasMany('products');
    });
    $api->resource('products')->relationships(static function ($relations) {
        $relations->hasOne('product_types');
    });

    Route::namespace('Api')->group(static function () {
        Route::post('/login', 'LoginController')->withoutMiddleware('auth:api');
        Route::post('/logout', 'LogoutController')->middleware('auth:api');

        Route::namespace('V1')->group(static function () {
            Route::group(['middleware' => 'client'], static function () {
                Route::get('/user', 'UserController');
            });
        });
    });
});
