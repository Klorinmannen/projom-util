<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Regex;

class Validate
{
    public static function float(int|float|string $float): bool
    {
        return Regex::matchFloat($float);
    }

    public static function int(int|float|string $int): bool
    {
        return Regex::matchInteger($int);
    }

    public static function integerID(int|float|string $id): bool
    {
        if ($id <= 0)
            return false;

        return Regex::matchIntegerID($id);
    }

    public static function text(string $string): bool
    {
        if ($string === '')
            return true;

        return Regex::matchText($string);
    }

    public static function query(string $query): bool
    {
        if ($query === '')
            return false;

        return Regex::matchQuery($query);
    }
}
