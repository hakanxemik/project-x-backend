<?php


namespace App\Enums;

use \Spatie\Enum\Enum;
/**
 * Category Tpyes Enum
 */
class CategoryTypes extends Enum
{
    protected static function values(): array
    {
        return [
            'party' => 1,
            'kulinarik' => 2,
            'games' => 3,
            'sport' => 4
        ];
    }
}

?>
