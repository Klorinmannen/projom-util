<?php

declare(strict_types=1);

namespace Projom\Util\File;

class Read
{
    public static function file(string $fullFilePath): ?string
    {
        if (!static::verifyFullFilePath($fullFilePath))
            return null;

        $ReadResult = file_get_contents($fullFilePath);

        return $ReadResult;
    }

    public static function verifyFullFilePath(string $fullFilePath): bool
    {
        if (!$fullFilePath)
            return false;

        if (!is_file($fullFilePath))
            return false;

        if (!is_readable($fullFilePath))
            return false;

        return true;
    }
}
