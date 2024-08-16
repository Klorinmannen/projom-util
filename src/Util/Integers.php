<?php

declare(strict_types=1);

namespace Projom\Util;

class Integers
{
    public static function isInt(string|int|float $subject): bool
    {
        $subject = (string) $subject;
        return is_numeric($subject) && strpos($subject, '.') === false;
    }
}
