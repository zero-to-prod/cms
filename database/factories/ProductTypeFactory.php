<?php

/** @var Factory $factory */

use App\Helpers\Helpers;
use App\Models\ProductType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ProductType::class, static function (Faker $faker) {
    $name = $faker->name;

    return [
        'name'        => $name,
        'slug'        => Helpers::slug($name),
        'description' => $faker->sentence,
    ];
});

$factory->state(ProductType::class, 'part', static function (Faker $faker) {
    $name = 'Part';

    return [
        'name'        => $name,
        'slug'        => Helpers::slug($name),
        'description' => "Description of $name.",
    ];
});

$factory->state(ProductType::class, 'assembly', static function (Faker $faker) {
    $name = 'Assembly';

    return [
        'name'        => $name,
        'slug'        => Helpers::slug($name),
        'description' => "Description of $name.",
    ];
});
