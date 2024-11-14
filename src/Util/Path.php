<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File;

class Path
{
	public static function canonizeUnix(string $fullPath): string
	{
		$fullPath = static::normalizeUnix($fullPath);
		$fullPath = File::removeExtension($fullPath);
		return $fullPath;
	}

	public static function normalizeUnix(string $fullPath)
	{
		return str_replace('\\', '/', $fullPath);
	}

	public static function absolute(string $fullFilePath): null|string
	{
		if (!$fullFilePath)
			return null;

		$absolutePath = realpath($fullFilePath);
		if ($absolutePath === false)
			return null;

		return $absolutePath;
	}
}
