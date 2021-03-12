<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $fillable = [
        'description',
    ];

    public function appointment(){
        return $this->blongsTo(Appointment::class);
    }

    public function doctorSpeciality() {
        return $this->blongsTo(DoctorSpeciality::class);
    }
}
