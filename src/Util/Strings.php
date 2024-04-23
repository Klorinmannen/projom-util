<?php

declare(strict_types=1);

namespace Projom\Util;

class Strings
{
    const TEXT_PATTERN = '/^.*$/';
    const QUERY_PATTERN = '/^[\w\/\.?=&]+$/';
    const SANTIZE_PATTERN = '/[^\w]+/';

    public static function sanitize(string $string): string
    {
        $pattern = static::SANTIZE_PATTERN;
        return preg_replace($pattern, '', $string);
    }

    public static function matchTextPattern(string $subject): bool
    {
        $pattern = static::TEXT_PATTERN;
        $match = preg_match($pattern, $subject) === 1;
        return $match;
    }

    public static function matchQueryPattern(string $subject): bool
    {
        $pattern = static::QUERY_PATTERN;
        $match = preg_match($pattern, $subject) === 1;
        return $match;
    }
}
