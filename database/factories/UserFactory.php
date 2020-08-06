<?php

/** @var Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(
    User::class,
    static function (Faker $faker) {
        return [
            'meta_id'           => 0,
            'contact_id'        => 0,
            'name'              => $faker->name,
            'email'             => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'can_login'         => 1,
            'remember_token'    => Str::random(10),
            'locale'            => config('api.locale_default'),
            'scopes'            => '',
            'created_at'        => now(),
            'updated_at'        => null,
            'deleted_at'        => null,
        ];
    }
);

$factory->state(
    User::class,
    'admin',
    static function (Faker $faker) {
        return [
            'name'      => config('admin.name'),
            'email'     => config('admin.email'),
            'password'  => Hash::make(config('admin.password')),
            'can_login' => 1,
            'meta_id'   => 0,
            'scopes'    => 'admin'
        ];
    }
);
