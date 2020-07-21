<?php

/** @var Factory $factory */

use App\Models\RequestLog;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(RequestLog::class, static function (Faker $faker) {
    return [
        'user_id'                     => factory(User::class),
        'path'                        => '/a/fake/path',
        'request_response_time_delta' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 10),
        'error'                       => 0,
        'error_message'               => $faker->randomHtml(),
        'created_at'                  => now(),
        'updated_at'                  => null
    ];
});