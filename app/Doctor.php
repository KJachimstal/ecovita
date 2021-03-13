<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\User;
use App\Speciality;
use App\DoctorSpeciality;
use App\Appointment;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'licensure',
    ];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function specialities() {
        return $this->belongsToMany(Speciality::class);
    }

    public function doctorSpecialities() {
        return $this->hasMany(DoctorSpeciality::class);
    }

    public function appointments() {
        return $this->hasManyThrough(Appointment::class, DoctorSpeciality::class);
    }
}
