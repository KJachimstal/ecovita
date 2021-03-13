<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\DoctorSpeciality;
use App\User;
use App\Detail;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'begin_date', 'status',
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
