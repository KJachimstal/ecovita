<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Details extends Model
{
    use HasStatuses;

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
