<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', static function (Request $request) {
    return $request->user();
});

/** @see \Tests\Uri\PingTest */
Route::get('/ping', 'Api\\PingController')->name('api.ping');
