<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Appointment;
use Faker\Generator as Faker;
use App\DoctorSpeciality;
use App\User;
use App\Enums\AppointmentStatus;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctor_speciality_id = DoctorSpeciality::all()->random()->id;
        $begin_date = $this->faker->dateTimeBetween('now', '+4 weeks');
        $user_id = $this->faker->randomElement([null, User::all()->random()->id]);
        $status = empty($user_id) ? AppointmentStatus::Available : AppointmentStatus::Booked;

        return [
            'doctor_speciality_id' => $doctor_speciality_id,
            'begin_date' => $begin_date,
            'user_id' => $user_id,
            'status' => $status,
        ];
    }
}