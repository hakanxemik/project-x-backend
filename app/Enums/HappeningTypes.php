<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 * @method static static INDOOR()
 * @method static static OUTDOOR()
 * @method static static HYBRID()
 */

final class HappeningTypes extends Enum
{
    const INDOOR = 'indoor';
    const OUTDOOR = 'outdoor';
    const HYBRID = 'HYBRID';
}
