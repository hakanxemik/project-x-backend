<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 * @method static static HOST()
 * @method static static GUEST()
 */

final class UserTypes extends Enum
{
    const HOST = 'host';
    const GUEST = 'guest';
}
