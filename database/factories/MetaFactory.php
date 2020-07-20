<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meta;
use App\Models\Site;
use App\Models\Status;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Meta::class, static function (Faker $faker) {
    $name = $faker->name;
    $slug = Str::slug($name);

    return [
        'site_id'     => Site::class,
        'user_id'     => User::class,
        'status_id'   => Status::class,
        'name'        => $name,
        'slug'        => $slug,
        'description' => $faker->sentence,
        'note'        => $faker->sentences(),
        'link'        => $faker->url,
    ];
});
