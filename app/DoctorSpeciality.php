<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    protected $table = 'doctor_speciality';

    public function appointments() {
        return $this->hasMany('App\Appointment');
    }

    public function doctor() {
        return $this->belongsTo('App\Doctor');
    }

    public function speciality() {
        return $this->belongsTo('App\Speciality');
    }
}
