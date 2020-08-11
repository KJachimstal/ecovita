<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'pesel', 'phone_number', 'city', 'post_code', 'street',
        'street_number',
    ];

    public function user() {
        return $this->morphOne('App\User', 'userable');
    }
}
