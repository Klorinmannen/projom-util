<?php

declare(strict_types=1);

namespace Projom\Util;

class Base64
{
    public static function encodeUrl(string $string): string
    {
        if (!$string)
            return '';

        $string = static::encode($string);
        return static::encodeUrlCharacters($string);
    }

    public static function encode(string $string): string
    {
        return base64_encode($string);
    }

    public static function encodeUrlCharacters(string $string): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], $string);
    }

    public static function decodeUrl(string $string): string
    {
        if (!$string)
            return '';

        $string = static::decodeUrlCharacters($string);
        return static::decode($string);
    }

    public static function decode(string $string): string
    {
        return base64_decode($string);
    }

    public static function decodeUrlCharacters(string $string): string
    {   
        return str_replace(['-', '_'], ['+', '/'], $string);
    }
}
