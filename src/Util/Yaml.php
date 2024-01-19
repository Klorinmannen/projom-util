<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File\Read;

class Yaml
{
    public static function parseFile(string $fullFilePath): array
    {
        if (!$fullFilePath)
            return [];

        if (!$yaml = Read::file($fullFilePath))
            return [];

        $decoded = yaml_parse($yaml);

        return $decoded;
    }
}
