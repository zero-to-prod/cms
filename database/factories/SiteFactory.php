<?php

/** @var Factory $factory */

use App\Models\Meta;
use App\Models\Site;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Site::class, static function (Faker $faker) {
    return [
        'meta_id'    => factory(Meta::class),
        'created_at' => now(),
        'updated_at' => null,
        'deleted_at' => null,
    ];
});
