<?php

/** @var Factory $factory */

use App\Models\Contact;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Contact::class, static function (Faker $faker) {
    $first_name        = $faker->firstName;
    $last_name         = $faker->lastName;
    $domain_name       = $faker->domainName;
    $domain_name_other = $faker->domainName;
    $email_name        = strtolower($first_name[0].$last_name);

    return [
        'user_id'             => factory(User::class),
        'title'               => $faker->title,
        'first_name'          => $first_name,
        'middle_name'         => strtoupper(Str::random(1)),
        'last_name'           => $last_name,
        'alias'               => $last_name,
        'gender'              => 'other',
        'birthday'            => $faker->dateTimeThisDecade,
        'job_title'           => $faker->jobTitle,
        'email'               => "$email_name@$domain_name",
        'email_other'         => "$email_name@$domain_name_other",
        'phone_number_mobile' => $faker->phoneNumber,
        'phone_number_home'   => $faker->phoneNumber,
        'phone_number_work'   => $faker->phoneNumber,
        'phone_number_other'  => $faker->phoneNumber,
        'fax_number_home'     => $faker->phoneNumber,
        'fax_number_work'     => $faker->phoneNumber,
        'fax_number_other'    => $faker->phoneNumber,
        'created_at'          => now(),
        'updated_at'          => null,
        'deleted_at'          => null,
    ];
});