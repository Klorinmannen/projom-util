<?php

declare(strict_types=1);

namespace Projom\Util;

class Integers
{
    const ID_PATTERN = '/^[1-9]+[0-9]*$/';
    const INT_PATTERN = '/^-?[0-9]+$/';

    public static function matchPattern(int $subject): bool
    {
        $pattern = static::INT_PATTERN;
        $match = preg_match($pattern, (string)$subject) === 1;
        return $match;
    }

    public static function matchIdPattern(int $subject): bool
    {
        $pattern = static::ID_PATTERN;
        $match = preg_match($pattern, (string)$subject) === 1;
        return $match;
    }
}
