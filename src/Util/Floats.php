<?php

declare(strict_types=1);

namespace Projom\Util;

class Floats
{
    /*
    * Rational numbers (Q) are a superset of Integers (Z).
    * Therefore integers will also match.
    */
    const FLOAT_PATTERN = '/^-?[0-9]+([\.,]{1}[0-9]+)?$/';

    public static function matchPattern(float $subject): bool
    {
        $pattern = static::FLOAT_PATTERN;
        $match = preg_match($pattern, (string)$subject) === 1;
        return $match;
    }
}
