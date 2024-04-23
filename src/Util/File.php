<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Json;
use Projom\Util\Yaml;

class File
{
    public static function write(string $fullFilePath, mixed $data): bool 
    {
        if (!static::isWriteable($fullFilePath))
            return false;

        file_put_contents($fullFilePath, $data, LOCK_EX);

        return true;
    }

    public static function isWriteable(string $fullFilePath): bool
    {
        $dir = dirname($fullFilePath);

        if (!is_dir($dir))
            return false;

        return is_writeable($dir);
    }

    public static function appendFile(string $fullFilePath, mixed $data): bool 
    {
        if (!static::isReadable($fullFilePath))
            return false;

        file_put_contents($fullFilePath, $data, LOCK_EX | FILE_APPEND);

        return true;
    }

    public static function read(string $fullFilePath): string|null
    {
        if (!static::isReadable($fullFilePath))
            return null;

        return file_get_contents($fullFilePath);
    }

    public static function isReadable(string $fullFilePath): bool
    {
        if (!file_exists($fullFilePath))
            return false;
        if (!is_file($fullFilePath))
            return false;
        if (!is_readable($fullFilePath))
            return false;
        return true;
    }

    public static function fullName(string $fullFilePath): string
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

    public static function parse(string $fullFilePath): array
    {
        if (!$fullFilePath)
            return [];

        $fileNameExt = File::fullName($fullFilePath);
        $extension = File::extension($fileNameExt);

        return match ($extension) {
            'json' => Json::parseFile($fullFilePath),
            'yml', 'yaml' => Yaml::parseFile($fullFilePath),
            'txt' => [static::read($fullFilePath)],
            default => throw new \Exception("File extension: $extension is not supported", 400),
        };
    }

    public static function parseList(array $fileList): array
    {
        $parsedFileList = [];

        foreach ($fileList as $fullFilePath) {

            $isReadable = File::isReadable($fullFilePath);
            if (!$isReadable)
                continue;

            $fileData = File::parse($fullFilePath);
            $fileName = File::name($fullFilePath);
            $parsedFileList[$fileName] = $fileData;
        }

        return $parsedFileList;
    }
}
