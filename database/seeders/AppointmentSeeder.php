<?php

namespace Database\Seeders;

use Illuminate\Database\Seeders;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Appointment::class, 20)->create();
    }
}
