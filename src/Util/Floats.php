<?php

declare(strict_types=1);

namespace Projom\Util;

class Floats
{
    public static function isFloat(string|int|float $subject): bool
    {
        $subject = (string) $subject;
        return is_numeric($subject) && strpos($subject, '.') !== false;
    }
}
