<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'pesel' => $faker->pesel,
        'phone_number' => $faker->phoneNumber,
        'city' => $faker->city,
        'post_code' => $faker->postcode,
        'street' => $faker->streetName,
        'street_number' => $faker->streetAddress,
    ];
});
