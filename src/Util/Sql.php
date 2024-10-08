<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\Arrays;
use Projom\Util\Strings;

class Sql
{
	public static function quoteList(array $list): array
	{
		return array_map([static::class, 'quote'], $list);
	}

	public static function quote(string $subject): string
	{
		$subject = Strings::clean($subject);

		if ($subject === '*')
			return $subject;

		return "`$subject`";
	}

	public static function quoteAndJoin(array $list, string $delimeter = ','): string
	{
		return Arrays::join(static::quoteList($list), $delimeter);
	}

	public static function splitThenQuoteAndJoin(string $subject, string $delimeter = ','): string
	{
		return static::quoteAndJoin(Strings::split($subject, $delimeter), $delimeter);
	}

	public static function splitAndQuote(string $subject, string $delimeter = ','): array
	{
		return static::quoteList(Strings::split($subject, $delimeter));
	}

	public static function splitAndQuoteThenJoin(string $subject, string $delimeter = ','): string
	{
		return Arrays::join(static::splitAndQuote($subject, $delimeter), $delimeter);
	}
}
