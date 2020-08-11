<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'licensure',
    ];

    public function user() {
        return $this->morphOne('App\User', 'userable');
    }

    public function specialities() {
        return $this->belongsToMany('App\Speciality');
    }
}