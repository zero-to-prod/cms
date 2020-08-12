<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(static function () {

    /** @see \App\Http\Controllers\Api\PingController */
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
        Route::post('/user/actions/is-email-unique', 'IsEmailUniqueController')->withoutMiddleware('auth:api');
    });

    Route::group(['namespace' => 'V1', 'middleware' => []], static function () {
        /** @see \App\Http\Controllers\Api\V1\UserShowController */
        Route::get('/user', 'UserShowController');

        /** @see \App\Http\Controllers\Api\V1\AuthLogController */
        Route::get('auth-log', 'AuthLogController')->middleware('scopes:admin');
    });
});
