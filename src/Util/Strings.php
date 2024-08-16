<?php

declare(strict_types=1);

namespace Projom\Util;

class Strings
{
    public static function toArray(string $subject, string $delimeter = ','): array
    {
        if (!$subject)
            return [];

        $list = [$subject];
        if (strpos($subject, $delimeter) !== false)
            $list = static::split($delimeter, $subject);
        return $list;
    }

    public static function clean(string $subject, string $remove = ' '): string
    {
        return str_replace($remove, '', trim($subject));
    }

    public static function split(string $subject, string $delimeter = ','): array
    {
        return explode($delimeter, $subject);
    }
}
