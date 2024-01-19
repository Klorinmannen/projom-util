<?php

declare(strict_types=1);

namespace Projom\Util;

class Validate
{
    public static function float(float $float): bool
    {
        return floats::matchPattern($float);
    }

    public static function int(int $int): bool
    {
        return integers::matchPattern($int);
    }

    public static function id(int $id): bool
    {
        if ($id <= 0)
            return false;

        return integers::matchIdPattern($id);
    }

    public static function textString(string $string): bool
    {
        if ($string === '')
            return true;

        return strings::matchTextPattern($string);
    }

    public static function queryString(string $query): bool
    {
        if ($query === '')
            return false;

        return strings::matchQueryPattern($query);
    }
}
