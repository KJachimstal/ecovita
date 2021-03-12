<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DoctorSpeciality;
use App\User;

class Appointment extends Model
{
    protected $fillable = [
        'begin_date', 'is_available',
    ];
    
    public function doctorSpeciality() {
        return $this->belongsTo(DoctorSpeciality::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detail() {
        return $this->hasOne(Detail::class);
    }
}
