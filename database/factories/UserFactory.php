<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'pesel' => $this->faker->pesel,
            'phone_number' => $this->faker->phoneNumber,
            'city' => $this->faker->city,
            'post_code' => $this->faker->postcode,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->streetAddress,
            'userable_type' => $this->faker->randomElement([
                App\Doctor::class,
                App\Employee::class,
                null
            ]),
            'userable_id' => function(array $user) {
                if (!$user['userable_type']) {
                    return null;
                }

                if ($user['userable_type'] == App\Doctor::class) {
                    return \App\Doctor::factory()->create()->id;
                }

                return \App\Employee::factory()->create()->id;
            }
        ];
    }
}