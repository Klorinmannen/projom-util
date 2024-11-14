<?php

declare(strict_types=1);

namespace Projom\Util;

class Regex
{
    private const FLOAT_PATTERN = '/^[+-]?[0-9]*[.,]{1}[0-9]+$/';
    private const NUMBER_PATTERN = '/^[+-]?([0-9]*[.,]{1})?[0-9]+$/';
    private const INT_PATTERN = '/^[+-]?[0-9]+$/';
    private const INT_POS_PATTERN = '/^[+]?[0-9]+$/';
    private const INT_NEG_PATTERN = '/^[-]{1}[0-9]+$/';
    private const INT_ID_PATTERN = '/^[1-9]+[0-9]*$/';
    private const TEXT_PATTERN = '/^.*$/';
    private const QUERY_PATTERN = '/^[\w\/\.?=&]+$/';
    private const SANTIZE_PATTERN = '/[^\w]+/';

    public static function matchFloat(int|float|string $subject): bool
    {
        $match = static::match(static::FLOAT_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchNumber(int|float|string $subject): bool
    {
        $match = static::match(static::NUMBER_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchInteger(int|float|string $subject): bool
    {
        $match = static::match(static::INT_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchPositiveInteger(int|float|string $subject): bool
    {
        $match = static::match(static::INT_POS_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchNegativeInteger(int|float|string $subject): bool
    {
        $match = static::match(static::INT_NEG_PATTERN, (string) $subject);
        return $match;
    }

    public static function matchIntegerID(int|float|string $subject): bool
    {
        $match = static::match(static::INT_ID_PATTERN, (string) $subject);
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

    public static function match(string $pattern, int|float|string $subject): bool
    {
        return preg_match($pattern, $subject) === 1;
    }

    /**
     * Returns the matches of the pattern in the subject. If no match is found, null is returned.
     */
    public static function pattern(string $pattern, string $subject): null|array
    {
        if (preg_match($pattern, $subject, $matches) === 1)
            return $matches;
        return null;
    }

    public static function sanitize(string $subject): string
    {
        $sanitizedSubject = preg_replace(static::SANTIZE_PATTERN, '', $subject);
        return $sanitizedSubject;
    }
}
