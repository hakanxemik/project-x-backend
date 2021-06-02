<?php


namespace App\Enums;

use \Spatie\Enum\Enum;
/**
 * Category Tpyes Enum
 */
class OfferingsTypes extends Enum
{
    protected static function values(): array
    {
        return [
            'alcohol' => 1,
            'non-alcohol' => 2,
            'vegan' => 3,
            'meals' => 4,
            'snacks' => 5,
            'grill' => 6,
            'cocktails' => 7,
            'fingerfoods' => 8,
            'veggie' => 9,
            'exotic' => 10,
            'helal' => 11
        ];
    }
}

?>
