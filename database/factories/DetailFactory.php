<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Register;
use Faker\Generator as Faker;
use App\Appointment;
use App\DoctorSpeciality;
use App\Detail;

class DetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Detail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctor_speciality_id = DoctorSpeciality::all()->random()->id;
        $appointment_id = Appointment::all()->random()->id();
    
        return [
            'appointment_id' => $appointment_id,
            'doctor_speciality_id' => $doctor_speciality_id,
            'description' => $this->faker->text,
        ];
    }
}
