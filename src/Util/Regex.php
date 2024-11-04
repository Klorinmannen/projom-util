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
        $match = static::match(static::INT_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchID(int $subject): bool
    {
        $match = static::match(static::ID_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchText(string $subject): bool
    {
        $match = static::match(static::TEXT_PATTERN, $subject);
        return $match;
    }

    public static function matchQuery(string $subject): bool
    {
        $match = static::match(static::QUERY_PATTERN, $subject);
        return $match;
    }

    public static function matchFloat(float $subject): bool
    {
        $match = static::match(static::FLOAT_PATTERN, (string) $subject);
        return $match;
    }

    public static function match(string $pattern, string $subject): bool
    {
        return preg_match($pattern, $subject) === 1;
    }

    public static function pattern(string $pattern, string $subject): array
    {
        if (preg_match($pattern, $subject, $matches) === 1)
            return $matches;
        return [];
    }

    public static function sanitize(string $subject): string
    {
        $sanitizedSubject = preg_replace(static::SANTIZE_PATTERN, '', $subject);
        return $sanitizedSubject;
    }
}
