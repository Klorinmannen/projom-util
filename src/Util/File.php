<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Dir;
use Projom\Util\Json;
use Projom\Util\Yaml;

class File
{
    private array $cache = [];

    public static function create(string $fullFilePath): bool
    {
        // If the path is pointing at a directory, cant do much.
        if (is_dir($fullFilePath))
            return false;

        // If file already exists, no need to create.
        if (file_exists($fullFilePath))
            return true;

        $isCreated = touch($fullFilePath);
        return $isCreated;
    }

    public static function write(string $fullFilePath, mixed $data, int $flags = LOCK_EX): bool
    {
        if (!static::isWriteable($fullFilePath))
            return false;

        $result = file_put_contents($fullFilePath, $data, $flags);
        if ($result === false)
            return false;

        return true;
    }

    public static function writeAppend(string $fullFilePath, mixed $data): bool
    {
        if (!static::isWriteable($fullFilePath))
            return false;

        $result = file_put_contents($fullFilePath, $data, LOCK_EX | FILE_APPEND);
        if ($result === false)
            return false;

        return true;
    }

    public static function isWriteable(string $fullFilePath): bool
    {
        if (!is_file($fullFilePath))
            return false;

        $isWriteable = is_writeable($fullFilePath);
        return $isWriteable;
    }

    public static function read(string $fullFilePath): null|string
    {
        if (!static::isReadable($fullFilePath))
            return null;

        $contents = file_get_contents($fullFilePath);
        if ($contents === false)
            return null;

        return $contents;
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

    public static function isReadable(string $fullFilePath): bool
    {
        if (!$fullFilePath)
            return false;
        if (!is_file($fullFilePath))
            return false;
        if (!is_readable($fullFilePath))
            return false;
        return true;
    }

    public static function name(string $fullFilePath): string
    {
        $fileName = pathinfo($fullFilePath, PATHINFO_BASENAME);
        return $fileName;
    }

    public static function filename(string $fullFilePath): string
    {
        $fileName = pathinfo($fullFilePath, PATHINFO_FILENAME);
        return $fileName;
    }

    public static function extension(string $fullFilePath): string
    {
        $extension = pathinfo($fullFilePath, PATHINFO_EXTENSION);
        return $extension;
    }

    public static function removeExtension(string $name): string
    {
        $extension = static::extension($name);
        $fileName = str_replace('.' . $extension, '', $name);
        return $fileName;
    }

    public static function directory(string $fullFilePath): string
    {
        $directory = dirname($fullFilePath);
        return $directory;
    }

    public static function parse(string $fullFilePath, bool $useCache = false): null|array
    {
        if (!$fullFilePath)
            return [];

        if ($useCache)
            if ($cachedFile = static::$cache[$fullFilePath] ?? false)
                return $cachedFile;

        $filename = File::name($fullFilePath);
        $extension = File::extension($filename);

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
            $fileName = static::filename($fullFilePath);
            $parsedFileList[$fileName] = $fileData;
        }

        return $parsedFileList;
    }
}
