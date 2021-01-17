<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;
use App\DoctorSpeciality;
use App\User;

$factory->define(Appointment::class, function (Faker $faker) {
    
    $doctor_speciality_id = DoctorSpeciality::all()->random()->id;
    $begin_date = $faker->dateTimeBetween('now', '+2 weeks');
    $user_id = $faker->randomElement([null, User::all()->random()->id]);
    
    if (empty($user_id)) {
        $is_avaliable = 1;
    }else {
        $is_avaliable = 0;
    }
    
    return [
        'doctor_speciality_id' => $doctor_speciality_id,
        'begin_date' => $begin_date,
        'user_id' => $user_id,
        'is_available' => $is_avaliable,
    ];
});
