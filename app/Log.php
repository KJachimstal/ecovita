<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ActionType;

class Log extends Model
{
    protected $connection = 'pgsql';

    public function getActionKeyAttribute() {
        return ActionType::getKey($this->action);
    }
}