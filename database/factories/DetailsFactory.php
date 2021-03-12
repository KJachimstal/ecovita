<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Register;
use Faker\Generator as Faker;
use App\Appointment;
use App\DoctorSpeciality;
use App\User;

$factory->define(Register::class, function (Faker $faker) {

    $doctor_speciality_id = DoctorSpeciality::all()->random()->id;
    $appointment_id = Appointment::all()->random()->id();

    return [
        'appointment_id' => $appointment_id,
        'doctor_speciality_id' => $doctor_speciality_id,
        'description' => $faker->text,
    ];
});
