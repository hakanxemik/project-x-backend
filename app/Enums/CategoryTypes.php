<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 * @method static static PARTY()
 * @method static static KULINARIK()
 * @method static static GAMES()
 * @method static static SPORT()
 */

final class CategoryTypes extends Enum
{
    const PARTY = 'Party';
    const KULINARIK = 'Kulinarik';
    const GAMES = 'Games';
    const SPORT = 'Sport';
}

