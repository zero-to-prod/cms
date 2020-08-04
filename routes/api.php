<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

JsonApi::register('default')->routes(static function ($api) {
    Route::namespace('Api')->group(static function () {

        Route::get('/', 'PingController')->withoutMiddleware('auth:api');


        /** @see \App\Http\Controllers\Api\PingController */
        Route::get('/ping', 'PingController')->withoutMiddleware('auth:api');

        /** @see \App\Http\Controllers\Api\V1\PingAuthorizedController */
        Route::get('/ping/authorized', 'PingAuthorizedController');

        /** @see \App\Http\Controllers\Api\RegisterController */
        Route::post('/register', 'RegisterController')->withoutMiddleware('auth:api');

        /** @see \App\Http\Controllers\Api\LoginController */
        Route::post('/login', 'LoginController')->withoutMiddleware('auth:api');

        /** @see \App\Http\Controllers\Api\LogoutController */
        Route::post('/logout', 'LogoutController');

        Route::group(['namespace' => 'V1\\User\\Actions'], static function () {
            /** @see \App\Http\Controllers\Api\V1\User\Actions\UpdateLocaleController */
            Route::post('/user/actions/update-locale', 'UpdateLocaleController');

            /** @see \App\Http\Controllers\Api\V1\User\Actions\UpdateNameController */
            Route::post('/user/actions/update-name', 'UpdateNameController');
        });

        Route::group(['namespace' => 'V1\\Users\\Actions'], static function () {
            /** @see \App\Http\Controllers\Api\V1\Users\Actions\IsEmailUniqueController */
            Route::post('/users/actions/is-email-unique', 'IsEmailUniqueController')->withoutMiddleware('auth:api');
        });

        Route::group(['namespace' => 'V1', 'middleware' => []], static function () {
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
});
