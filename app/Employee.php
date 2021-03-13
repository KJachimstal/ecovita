<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\User;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'permissions',
    ];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }
}
