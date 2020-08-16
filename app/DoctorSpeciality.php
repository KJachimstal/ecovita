<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    protected $table = 'doctor_speciality';

    public function appointments() {
        return $this->hasMany('App\Appointment');
    }
}
