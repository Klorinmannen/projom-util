<?php

declare(strict_types=1);

namespace Projom\Util;

class Format
{
	const INT = 'int';
	const FLOAT = 'float';
	const BOOL = 'bool';
	const STRING = 'string';
	const DATE = 'date';
	const DATETIME = 'datetime';

	public static function value(mixed $value, string $type): mixed
	{
		$type = strtolower($type);
		return match ($type) {
			'int' => (int) $value,
			'float' => (float) $value,
			'bool' => (bool) $value,
			'string' => (string) $value,
			'date' => date('Y-m-d', strtotime((string) $value)),
			'datetime' => date('Y-m-d H:i:s', strtotime((string) $value)),
			default => $value,
		};
	}

	public static function values(array $values): array
	{
		$formatted = [];
		foreach ($values as $index => [$type, $value])
			$formatted[$index] = static::value($value, $type);
		return $formatted;
	}
}
