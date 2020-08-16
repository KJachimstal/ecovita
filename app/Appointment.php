<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'begin_date', 'is_available',
    ];
    
    public function doctorSpeciality() {
        return $this->belongsTo('App\DoctorSpeciality');
    }
}
