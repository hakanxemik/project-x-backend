<?php


namespace App\Enums;

use \Spatie\Enum\Enum;
/**
 * Category Tpyes Enum
 */
class CategoryColors extends Enum
{
    protected static function values(): array
    {
        return [
            'green' => 1,
            'blue' => 2,
            'red' => 3,
            'yellow' => 4
        ];
    }
}

?>
