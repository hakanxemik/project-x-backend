<?php


namespace App\Enums;

use \Spatie\Enum\Enum;
/**
 * Category Tpyes Enum
 */
class HappeningTypes extends Enum
{
    protected static function values(): array
    {
        return [
            'indoor' => 1,
            'outdoor' => 2,
            'hybrid' => 3
        ];
    }
}

?>
