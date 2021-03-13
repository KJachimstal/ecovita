<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AppointmentStatus extends Enum
{
    const Available = 0;
    const Booked = 1;
    const Pending = 2;
    const Finished = 3;
}
