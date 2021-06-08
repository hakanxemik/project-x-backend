<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 * @method static static ALC()
 * @method static static NONALC()
 * @method static static VEGAN()
 * @method static static MEALS()
 * @method static static SNACKS()
 * @method static static GRILL()
 * @method static static COCKTAILS()
 * @method static static FINGERFOOD()
 * @method static static VEGGY()
 * @method static static EXOTIC()
 * @method static static HELAL()
 */

final class OfferingTypes extends Enum
{
    const ALC = 'alc';
    const NONALC = 'nonalc';
    const VEGAN = 'vegan';
    const MEALS = 'meals';
    const SNACKS = 'snacks';
    const GRILL = 'grill';
    const COCKTAILS = 'cocktails';
    const FINGERFOOD = 'fingerfood';
    const VEGGY = 'veggy';
    const EXOTIC = 'exotic';
    const HELAL = 'helal';
}
