<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', static function (Request $request) {
//     return $request->user();
// });

JsonApi::register('default')->routes(static function ($api) {
    $api->resource('product_types')->relationships(static function ($relations) {
        $relations->hasMany('products');
    });
    $api->resource('products')->relationships(static function ($relations) {
        $relations->hasOne('product_types');
    });

    Route::namespace('Api')->group(static function () {
        Route::post('/register', 'RegisterController');
        Route::post('/login', 'LoginController');
        Route::middleware('auth:api')->post('/logout', 'LogoutController');
        Route::namespace('V1')->group(static function () {
            /** @see \Tests\Uri\V1\LoginMachineToMachineTest */
            Route::post('/login-machine-to-machine', 'LoginMachineToMachineController')->name('api.v1.login-machine');
            Route::group(['middleware' => 'client'], static function () {

            });
        });
    });
});
