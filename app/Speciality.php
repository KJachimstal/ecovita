<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doctor;

class Speciality extends Model
{
    protected $fillable = [
        'name',
    ];

    public function doctors() {
        return $this->belongsToMany(Doctor::class);
    }
}
