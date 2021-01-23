<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'pgsql';

    protected $fillable = [
        'user_id', 'full_name', 'ip_address', 'description'
    ];
}
