<?php

/** @var Factory $factory */

use App\Models\Meta;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Meta::class, static function (Faker $faker) {
    $name = $faker->name;
    $slug = Str::slug($name);
    $user = factory(User::class)->create();

    return [
        'user_id'            => $user->id,
        'user_id_created_at' => $user->id,
        'user_id_updated_at' => null,
        'user_id_deleted_at' => null,
        'name'               => $name,
        'slug'               => $slug,
        'description'        => $faker->sentence,
        'note'               => $faker->sentence,
        'help'               => $faker->randomHtml(),
        'link'               => $faker->url,
        'color'              => $faker->colorName,
        'created_at'         => now(),
        'updated_at'         => null,
        'deleted_at'         => null,
    ];
});
