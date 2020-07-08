<?php

use App\Events\OrderShipped;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

JsonApi::register('default')->routes(static function ($api) {
    Route::namespace('Api')->group(static function () {
        Route::post('/register', 'RegisterController')->withoutMiddleware('auth:api');
        Route::post('/login', 'LoginController')->withoutMiddleware('auth:api');
        Route::post('/logout', 'LogoutController');
        Route::get('/ship', function (Request $request)
        {
            $id = $request->input('id');
            event(new OrderShipped($id)); // trigger event
            return response('Order Shipped!', 200);
        });
        Route::group(['namespace' => 'V1\\Users\\Actions'], static function () {
            /** @see \App\Http\Controllers\Api\V1\Users\Actions\IsEmailUniqueController */
            /** @see \Tests\Api\V1\Users\Actions\IsEmailUniqueTest */
            Route::post('/users/actions/is-email-unique', 'IsEmailUniqueController')->withoutMiddleware('auth:api');

            /** @see \App\Http\Controllers\Api\V1\Users\Actions\IsNameUniqueController */
            /** @see \Tests\Api\V1\Users\Actions\IsNameUniqueTest */
            Route::post('/users/actions/is-name-unique', 'IsNameUniqueController')->withoutMiddleware('auth:api');
        });

        Route::group(['namespace' => 'V1', 'middleware' => 'client'], static function () {
            Route::get('/user', 'UserController');
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
