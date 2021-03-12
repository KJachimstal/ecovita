<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = [
        'description',
    ];

    public function doctorSpeciality() {
        return $this->hasOne(DoctorSpeciality::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
