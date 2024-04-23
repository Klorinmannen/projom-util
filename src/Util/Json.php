<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File;
use SebastianBergmann\Type\NullType;

class Json
{
    public static function parseFile(string $fullFilePath): array
    {
        if (!$fullFilePath)
            return [];

        if (!$json = File::read($fullFilePath))
            return [];

        if (!$decoded = static::verifyAndDecode($json))
            return [];

        return $decoded;
    }

    public static function verifyAndDecode(
        string $jsonString,
        bool $asArray = true
    ): ?array {

        if (!$jsonString)
            return null;

        $result = static::verify($jsonString);
        if ($result === false)
            return null;

        return static::decode($jsonString, $asArray);
    }

    public static function decode(string $jsonString, bool $asArray = true): array|null
    {
        if (!$jsonString)
            return null;

        $result = json_decode($jsonString, $asArray);
        if ($result === null)
            return null;

        return $result;
    }

    public static function verify(string $jsonString): bool
    {
        if (!$jsonString)
            return false;

        static::decode($jsonString);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public static function encode(array $toEncode, bool $prettyPrint = false): string|null
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
