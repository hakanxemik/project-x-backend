<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 * @method static static WANDERN()
 * @method static static ZOCKEN()
 * @method static static NETFLIX()
 * @method static static REISEN()
 */

final class InterestTypes extends Enum
{
    const WANDERN = 'wandern';
    const ZOCKEN = 'zocken';
    const REISEN = 'reisen';
    const NETFLIX = 'netflix';
}
