<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Doctor;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'licensure' => $this->faker->ean8,
            'academic_degree' => $this->faker->randomElement([
                'lek. med.',
                'dr n. med.',
                'dr hab n. med.',
                'prof. dr hab'
            ])

        ];
    }
}
