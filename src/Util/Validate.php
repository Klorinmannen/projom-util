<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Regex;

class Validate
{
    public static function float(float $float): bool
    {
        return Regex::matchFloat($float);
    }

    public static function int(int $int): bool
    {
        return Regex::matchInteger($int);
    }

    public static function id(int $id): bool
    {
        if ($id <= 0)
            return false;

        return Regex::matchID($id);
    }

    public static function textString(string $string): bool
    {
        if ($string === '')
            return true;

        return Regex::matchText($string);
    }

    public static function queryString(string $query): bool
    {
        if ($query === '')
            return false;

        return Regex::matchQuery($query);
    }
}
