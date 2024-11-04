<?php

declare(strict_types=1);

namespace Projom\Util;

class Random
{
    public static function string(null|int $length = null, int $bytes = 10): string
    {
        $hex = bin2hex(random_bytes($bytes));
        if ($length === null)
            return $hex;

        return substr($hex, 0, $length);
    }
}
