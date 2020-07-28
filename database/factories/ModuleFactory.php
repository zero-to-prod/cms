<?php

/** @var Factory $factory */

use App\Models\Meta;
use App\Models\Module;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(
    Module::class,
    static function (Faker $faker) {
        $name = $faker->name;
        $slug = Str::slug($name);

        return [
            'meta_id'    => factory(Meta::class),
            'name'       => $name,
            'slug'       => $slug,
            'path'       => $faker->url,
            'is_enabled' => 0,
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,
        ];
    }
);

$factory->state(
    Module::class,
    'enabled',
    static function (Faker $faker) {
        return [
            'is_enabled' => 1,
        ];
    }
);

$factory->state(
    Module::class,
    'disabled',
    static function (Faker $faker) {
        return [
            'is_enabled' => 0,
        ];
    }
);