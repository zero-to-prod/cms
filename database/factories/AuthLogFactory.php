<?php

/** @var Factory $factory */

use App\Models\AuthLog;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;

$factory->define(AuthLog::class, static function (Faker $faker) {
    $url = $faker->url;

    return [
        'user_id'     => factory(User::class),
        'login'       => null,
        'logout'      => null,
        'url'         => $url,
        'full_url'    => $url,
        'path'        => '/a/fake/path',
        'secure'      => 0,
        'user_agent'  => $faker->userAgent,
        'fingerprint' => Hash::make('secret'),
        'ip_address'  => $faker->ipv4,
        'created_at'  => time(),
        'updated_at'  => null,
    ];
});

$factory->state(AuthLog::class, 'login', [
    'login' => 1,
]);

$factory->state(AuthLog::class, 'logout', [
    'logout' => 1,
]);
