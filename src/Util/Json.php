<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File;

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

    public static function decode(
        string $jsonString,
        bool $asArray = true
    ): ?array {

        if (!$jsonString)
            return null;

        $result = json_decode($jsonString, $asArray);
        if ($result === null)
            return null;

        return $result;
    }

    public static function verify(string $jsonString): bool
    {
        // Quick cheap dummy checks.
        if (strlen($jsonString) < 2)
            return false;
       
        if (strpos($jsonString, '{', 0) === false 
            && strpos($jsonString, '[', 0) === false)
            return false;
        
        if (strpos($jsonString, '}', -1) === false
            && strpos($jsonString, ']', -1) === false)
            return false;

        // The only real way to properly check is by decoding.
        static::decode($jsonString);
        if (json_last_error() != JSON_ERROR_NONE)
            return false;

        return true;
    }

    public static function encode(
        array $toEncode,
        bool $prettyPrint = false
    ): ?string {

        $flags = 0;
        if ($prettyPrint)
            $flags = JSON_PRETTY_PRINT;

        $encoded = json_encode($toEncode, $flags);
        if ($encoded === false)
            return null;

        return $encoded;
    }
}
