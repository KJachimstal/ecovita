<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name',
    ];

    public function doctors() {
        return $this->belongsToMany('App\Doctor');
    }
}
