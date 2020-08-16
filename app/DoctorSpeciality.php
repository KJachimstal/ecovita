<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    public function appointments() {
        return $this->hasMany('App\Appointment');
    }
}
