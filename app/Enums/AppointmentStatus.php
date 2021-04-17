<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AppointmentStatus extends Enum
{
    const Available = 0;
    const Booked = 1;
    const Pending = 2;
    const Finished = 3;

    public static function getKey($value): string {
        return strtolower(parent::getKey($value));
    }
}
