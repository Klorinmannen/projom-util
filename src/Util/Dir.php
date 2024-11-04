<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File;

class Dir
{
    public static function systemPath(string $srcDir = 'src'): string
    {
        $dir = __DIR__;
        $srcPos = strpos($dir, $srcDir);
        if ($srcPos === false)
            return '';

        $systemDir = rtrim(
            substr($dir, 0, $srcPos),
            DIRECTORY_SEPARATOR
        );

        return $systemDir;
    }

    public static function parse(string $fullDirPath): array
    {
        $readable = Dir::isReadable($fullDirPath);
        if (!$readable)
            return [];

        $fileList = scandir($fullDirPath);
        if (!$fileList)
            return [];

        $fileList = static::cleanFileList($fileList);
        $fileList = static::prependfullDirPath($fullDirPath, $fileList);

        $parsedFileList = File::parseList($fileList);

        return $parsedFileList;
    }

    public static function isReadable(string $fullDirPath): bool
    {
        if (!$fullDirPath)
            return false;
        if (!is_dir($fullDirPath))
            return false;
        if (!is_readable($fullDirPath))
            return false;
        return true;
    }

    public static function create(string $fullDirPath, int $permission = 0777, bool $recursive = false): bool
    {
        if (is_dir($fullDirPath))
            return true;

        $isCreated = mkdir($fullDirPath, $permission, $recursive);
        return $isCreated;
    }

    public static function cleanFileList(array $fileList): array
    {
        $unwanted = [
            '.',
            '..'
        ];
        return array_diff($fileList, $unwanted);
    }

    public static function prependfullDirPath(string $fullDirPath, array $fileList): array 
    {
        return array_map(fn ($file) => $fullDirPath . DIRECTORY_SEPARATOR . $file, $fileList);
    }
}
