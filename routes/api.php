<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', static function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->group(static function () {
    /** @see \Tests\Uri\PingTest */
    Route::get('/ping', 'PingController')->name('api.ping');
});

