<?php

declare(strict_types=1);

namespace Projom\Util;

class Bools
{
    const TRUE = 'true';
    const FALSE = 'false';

    public static function toBoolean(string $boolString): ?bool
    {
        $boolString = strtolower($boolString);

        if ($boolString === static::TRUE)
            return true;

        if ($boolString === static::FALSE)
            return false;

        return null;
    }
}
