<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ActionType extends Enum
{
    const Create = 0;
    const Update = 1;
    const Delete = 2;
    const View = 3;

    public static function getKey($value): string {
        return strtolower(parent::getKey($value));
    }
}
