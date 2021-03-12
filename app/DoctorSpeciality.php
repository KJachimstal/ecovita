<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Appointment;
use App\Doctor;
use App\Speciality;

class DoctorSpeciality extends Model
{
    protected $table = 'doctor_speciality';

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function speciality() {
        return $this->belongsTo(Speciality::class);
    }

    public function getNameAttribute() {
        return "{$this->doctor->user->fullName} - {$this->speciality->name}";
    }

    public function detail() {
        return $this->hasOne(Detail::class);
    }
}
