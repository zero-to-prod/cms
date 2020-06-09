<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', static function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->group(static function () {
    /** @see \Tests\Uri\PingTest */
    Route::get('/ping', 'PingController')->name('api.ping');
    Route::prefix('v1')->namespace('V1')->group(static function () {
        /** @see \Tests\Uri\V1\LoginMachineTest */
        Route::post('/login-machine-to-machine', 'LoginMachineToMachineController')->name('api.v1.login-machine');
        Route::group(['middleware' => 'client'], static function () {
            /** @see \Tests\Uri\V1\PingAuthorizedTest */
            Route::get('ping-authorized', 'PingAuthorizedController')->name('api.ping-authorize');
        });
    });
});
