<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

JsonApi::register('default')->routes(static function ($api) {
    Route::namespace('Api')->group(static function () {
        Route::get('/ping/authorized', 'PingController');
        Route::get('/ping', 'PingController')->withoutMiddleware('auth:api');
        Route::post('/register', 'RegisterController')->withoutMiddleware('auth:api');
        /** @see \App\Http\Controllers\Api\LoginController */
        /** @see \Tests\Api\V1\LoginControllerTest */
        Route::post('/login', 'LoginController')->withoutMiddleware('auth:api');
        /** @see \App\Http\Controllers\Api\LogoutController */
        Route::post('/logout', 'LogoutController');
        Route::group(['namespace' => 'V1\\Users\\Actions'], static function () {
            /** @see \App\Http\Controllers\Api\V1\Users\Actions\IsEmailUniqueController */
            /** @see \Tests\Api\V1\Users\Actions\IsEmailUniqueTest */
            Route::post('/users/actions/is-email-unique', 'IsEmailUniqueController')->withoutMiddleware('auth:api');
        });

        Route::group(['namespace' => 'V1'], static function () {
            Route::get('/user', 'UserController');
            Route::get('auth-log', 'AuthLogController');
        });
    });

    $api->resource('users');

    $api->resource('product_types')->relationships(static function ($relations) {
        $relations->hasMany('products');
    });
    $api->resource('products')->relationships(static function ($relations) {
        $relations->hasOne('product_types');
    });

    // $api->resource('auth-logs')->relationships(static function ($relations) {
    //     $relations->hasOne('user');
    // });
});
