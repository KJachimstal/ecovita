<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Employee extends Model
{
    protected $fillable = [
        'permissions',
    ];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }
}
