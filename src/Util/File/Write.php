<?php

declare(strict_types=1);

namespace Projom\Util\File;

class Write
{
    public static function file(
        string $fullFilePath,
        mixed $data
    ): ?int {

        if (!static::verifyFullFilePath($fullFilePath))
            return null;

        $writeResult = file_put_contents($fullFilePath, $data, LOCK_EX);
        
        return $writeResult;
    }

    public static function appendFile(
        string $fullFilePath,
        mixed $data
    ): ?int {

        if (!static::verifyFullFilePath($fullFilePath))
            return null;

        $writeResult = file_put_contents($fullFilePath, $data, LOCK_EX | FILE_APPEND);

        return $writeResult;
    }

    public static function verifyFullFilePath(string $fullFilePath): bool
    {
        if (!$fullFilePath)
            return false;

        $dir = dirname($fullFilePath);
        if (!is_writeable($dir))
            return false;

        return true;
    }
}
