<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Register;
use Faker\Generator as Faker;
use App\Appointment;
use App\DoctorSpeciality;
use App\User;

$factory->define(Register::class, function (Faker $faker) {

    $doctor_speciality_id = DoctorSpeciality::all()->random()->id;
    $begin_date = $faker->dateTimeBetween('now', '+2 weeks');
    $user_id = $faker->randomElement([null, User::all()->random()->id]);

    return [
        'visit_date' => $begin_date,
        'user_id' => $user_id,
        'doctor_speciality_id' => $doctor_speciality_id,
        'description' => $faker->text,
    ];
});
