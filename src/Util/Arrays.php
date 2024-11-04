<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Strings;

class Arrays
{
	public static function clean(array $list): array
	{
		return array_map([Strings::class, 'clean'], $list);
	}

	public static function join(array $list, string $delimeter = ','): string
	{
		return implode($delimeter, $list);
	}

	public static function flatten(array $list): array
	{
		return array_merge(...$list);
	}

	public static function merge(array ...$lists): array
	{
		return array_merge(...$lists);
	}

	public static function removeEmpty(array $list): array
	{
		return array_filter($list);
	}

	public static function rekey(array $records, string $field): array
	{
		return array_column($records, null, $field);
	}
}
