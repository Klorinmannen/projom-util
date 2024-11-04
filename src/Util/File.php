<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Dir;
use Projom\Util\Json;
use Projom\Util\Yaml;

class File
{
    private array $cache = [];

    public static function write(string $fullFilePath, mixed $data, int $flags = LOCK_EX): bool
    {
        if (!static::isWriteable($fullFilePath))
            return false;

        file_put_contents($fullFilePath, $data, $flags);

        return true;
    }

    public static function isWriteable(string $fullFilePath): bool
    {
        $dir = dirname($fullFilePath);
        if (!is_dir($dir))
            return false;

        return is_writeable($dir);
    }

    public static function writeAppend(string $fullFilePath, mixed $data): bool
    {
        if (!static::isReadable($fullFilePath))
            return false;

        file_put_contents($fullFilePath, $data, LOCK_EX | FILE_APPEND);

        return true;
    }

    public static function read(string $fullFilePath): null|string
    {
        if (!static::isReadable($fullFilePath))
            return null;

        return file_get_contents($fullFilePath);
    }

    public static function isReadable(string $fullFilePath): bool
    {
        if (!is_file($fullFilePath))
            return false;
        if (!is_readable($fullFilePath))
            return false;
        return true;
    }

    public static function fullname(string $fullFilePath): string
    {
        $baseName = pathinfo($fullFilePath, PATHINFO_BASENAME);
        return $baseName;
    }

    public static function name(string $fullFilePath): string
    {
        $fileName = pathinfo($fullFilePath, PATHINFO_FILENAME);
        return $fileName;
    }

    public static function extension(string $fullFilePath): string
    {
        $extension = pathinfo($fullFilePath, PATHINFO_EXTENSION);
        return $extension;
    }

    public static function removeExtension(string $fullFilePath): string
    {
        $extension = pathinfo($fullFilePath, PATHINFO_EXTENSION);
        $fileName = str_replace('.' . $extension, '', $fullFilePath);
        return $fileName;
    }

    public static function directory(string $fullFilePath): string
    {
        $directory = dirname($fullFilePath);
        return $directory;
    }

    public static function move(string $from, string $to): bool
    {
        if (!static::isReadable($from))
            return false;

        $dir = static::directory($to);
        if (!Dir::isReadable($dir))
            return false;

        $isMoved = rename($from, $to);
        return $isMoved;
    }

    public static function canonizeUnixPath(string $fullPath): string
    {
        $fullPath = File::normalizeUnixPath($fullPath);
        $fullPath = File::removeExtension($fullPath);
        return $fullPath;
    }

    public static function normalizeUnixPath(string $fullPath)
    {
        return str_replace('\\', '/', $fullPath);
    }

    public static function parse(string $fullFilePath, bool $useCache = false): null|array
    {
        if (!$fullFilePath)
            return [];

        if ($useCache)
            if ($cachedFile = static::$cache[$fullFilePath] ?? false)
                return $cachedFile;

        $fileNameExt = File::fullName($fullFilePath);
        $extension = File::extension($fileNameExt);

        $parsedFile = match ($extension) {
            'json' => Json::parseFile($fullFilePath),
            'yml', 'yaml' => Yaml::parseFile($fullFilePath),
            'txt' => [static::read($fullFilePath)],
            default => null,
        };

        if ($useCache)
            static::$cache[$fullFilePath] = $parsedFile;

        return $parsedFile;
    }

    public static function parseList(array $fileList, bool $useCache = false): array
    {
        $parsedFileList = [];

        foreach ($fileList as $fullFilePath) {

            $isReadable = static::isReadable($fullFilePath);
            if (!$isReadable)
                continue;

            $fileData = static::parse($fullFilePath, $useCache);
            $fileName = static::name($fullFilePath);
            $parsedFileList[$fileName] = $fileData;
        }

        return $parsedFileList;
    }
}
