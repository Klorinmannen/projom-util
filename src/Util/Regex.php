<?php

declare(strict_types=1);

namespace Projom\Util;

class Regex
{
    /*
    * Rational numbers (Q) are a superset of Integers (Z).
    * Therefore integers will also match.
    */
    const FLOAT_PATTERN = '/^-?[0-9]+([\.,]{1}[0-9]+)?$/';

    const ID_PATTERN = '/^[1-9]+[0-9]*$/';
    const INT_PATTERN = '/^-?[0-9]+$/';
    const TEXT_PATTERN = '/^.*$/';
    const QUERY_PATTERN = '/^[\w\/\.?=&]+$/';
    const SANTIZE_PATTERN = '/[^\w]+/';

    public static function matchInteger(int $subject): bool
    {
        $pattern = static::INT_PATTERN;
        $match = preg_match($pattern, (string) $subject) === 1;
        return $match;
    }

    public static function matchID(int $subject): bool
    {
        $pattern = static::ID_PATTERN;
        $match = preg_match($pattern, (string) $subject) === 1;
        return $match;
    }

    public static function sanitize(string $subject): string
    {
        $pattern = static::SANTIZE_PATTERN;
        return preg_replace($pattern, '', $subject);
    }

    public static function matchText(string $subject): bool
    {
        $pattern = static::TEXT_PATTERN;
        $match = preg_match($pattern, $subject) === 1;
        return $match;
    }

    public static function matchQuery(string $subject): bool
    {
        $pattern = static::QUERY_PATTERN;
        $match = preg_match($pattern, $subject) === 1;
        return $match;
    }

    public static function matchFloat(float $subject): bool
    {
        $pattern = static::FLOAT_PATTERN;
        $match = preg_match($pattern, (string) $subject) === 1;
        return $match;
    }

    public static function pattern(string $pattern, string $subject): array
    {
        if (preg_match($pattern, $subject, $matches) === 1)
            return $matches;
        return [];
    }
}
