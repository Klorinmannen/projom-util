<?php

declare(strict_types=1);

namespace Projom\Util;

class Random
{
    public static function numberString(
        int $length = 0,
        int $bytes = 10
    ): string {

        $hex = bin2hex(random_bytes($bytes));
        if ($length === 0)
            return $hex;
            
        return substr($hex, 0, $length);
    }
}
