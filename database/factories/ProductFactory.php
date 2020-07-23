<?php

/** @var Factory $factory */

use App\Helpers\Helper;
use App\Models\Product;
use App\Models\ProductType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, static function (Faker $faker) {
    $name = $faker->name;

    return [
        'name'            => $name,
        'slug'            => Helper::slug($name),
        'description'     => $faker->sentence,
        'product_type_id' => factory(ProductType::class),
    ];
});
