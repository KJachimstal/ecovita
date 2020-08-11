<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'permissions',
    ];

    public function user() {
        return $this->morphOne('App\User', 'userable');
    }
}
