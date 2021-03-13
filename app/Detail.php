<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\DoctorSpeciality;
use App\Appointment;

class Details extends Model
{
    use HasFactory;

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
