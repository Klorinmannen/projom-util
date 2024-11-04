<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File;

class Json
{
    public static function parseFile(string $fullFilePath): null|array
    {
        if (!$fullFilePath)
            return null;

        if (!$json = File::read($fullFilePath))
            return null;

        return static::verifyAndDecode($json);
    }

    public static function verifyAndDecode(string $jsonString, bool $asArray = true): null|array
    {
        if (!$jsonString)
            return null;

        $result = static::verify($jsonString);
        if ($result === false)
            return null;

        return static::decode($jsonString, $asArray);
    }

    public static function decode(string $jsonString, bool $asArray = true): null|array
    {
        if (!$jsonString)
            return null;

        $decoded = json_decode($jsonString, $asArray);
        return $decoded;
    }

    public static function verify(string $jsonString): bool
    {
        if (!$jsonString)
            return false;

        static::decode($jsonString);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public static function encode(array $toEncode, bool $prettyPrint = false): null|string
    {
        $flags = 0;
        if ($prettyPrint)
            $flags = JSON_PRETTY_PRINT;

        $encoded = json_encode($toEncode, $flags);
        if ($encoded === false)
            return null;

        return $encoded;
    }
}
