<?php

use Illuminate\Database\Seeder;
use App\Doctor;
use App\Speciality;

class DoctorSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = Doctor::all();

        foreach($doctors as $doctor) {
            $specialitiesCount = rand(1, 3);
            $specialities = Speciality::all()->random($specialitiesCount);
            $doctor->specialities()->attach($specialities->pluck('id'));
        }
    }
}
