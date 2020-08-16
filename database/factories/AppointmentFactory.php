<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;
use App\DoctorSpeciality;
use App\Patient;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'doctor_speciality_id' => DoctorSpeciality::all()->random()->id,
        'begin_date' => $faker->dateTimeBetween('now', '+2 weeks'),
        'patient_id' => $faker->randomElement([null, Patient::all()->random()->id]),
        'is_available' => $faker->boolean(),
    ];
});
