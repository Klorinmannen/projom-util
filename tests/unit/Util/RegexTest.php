<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Regex;

class RegexTest extends TestCase
{
	public static function matchIntegerProvider(): array
	{
		return [
			[
				'subject' => 5,
				'expected' => true
			],
			[
				'subject' => -5,
				'expected' => true
			],
			[
				'subject' => 0,
				'expected' => true
			],
			[
				'subject' => 999,
				'expected' => true
			],
			[
				'subject' => -999,
				'expected' => true
			]
		];
	}

	#[Test]
	#[DataProvider('matchIntegerProvider')]
	public function matchInteger(int $subject, bool $expected): void
	{
		$actual = Regex::matchInteger($subject);
		$this->assertEquals($expected, $actual);
	}

	public static function matchIDProvider(): array
	{
		return [
			[
				'subject' => 5,
				'expected' => true
			],
			[
				'subject' => -5,
				'expected' => false
			],
			[
				'subject' => 0,
				'expected' => false
			],
			[
				'subject' => 999,
				'expected' => true
			],
			[
				'subject' => -999,
				'expected' => false
			]
		];
	}

	#[Test]
	#[DataProvider('matchIDProvider')]
	public function matchID(int $subject, bool $expected): void
	{
		$actual = Regex::matchID($subject);
		$this->assertEquals($expected, $actual);
	}

	public static function matchFloatProvider(): array
	{
		return [
			[
				'subject' => 1,
				'expected' => true
			],
			[
				'subject' => 1.2,
				'expected' => true
			],
			[
				'subject' => 1.2,
				'expected' => true
			],
			[
				'subject' => 1001,
				'expected' => true
			],
			[
				'subject' => 1001.1001,
				'expected' => true
			],
			[
				'subject' => 0,
				'expected' => true
			],
			[
				'subject' => -1001.1001,
				'expected' => true
			]
		];
	}

	#[Test]
	#[DataProvider('matchFloatProvider')]
	public function matchFloat(float $subject, bool $expected): void
	{
		$actual = Regex::matchFloat($subject);
		$this->assertEquals($expected, $actual);
	}

	public static function sanitizeProvider(): array
	{
		return [
			[
				'string' => 'helloWorld!',
				'expected' => 'helloWorld'
			],
			[
				'string' => 'special@#$%characters',
				'expected' => 'specialcharacters'
			],
			[
				'string' => '',
				'expected' => ''
			]
		];
	}

	#[Test]
	#[DataProvider('sanitizeProvider')]
	public function sanitize(string $string, string $expected): void
	{
		$actual = Regex::sanitize($string);
		$this->assertEquals($expected, $actual);
	}

	public static function matchTextProvider(): array
	{
		return [
			[
				'subject' => 'test',
				'expected' => true
			],
			[
				'subject' => 'with space',
				'expected' => true
			],
			[
				'subject' => '123',
				'expected' => true
			],
			[
				'subject' => '',
				'expected' => true
			]
		];
	}

	#[Test]
	#[DataProvider('matchTextProvider')]
	public function matchText(string $subject, bool $expected): void
	{
		$actual = Regex::matchText($subject);
		$this->assertEquals($expected, $actual);
	}

	public static function matchQueryProvider(): array
	{
		return [
			[
				'subject' => 'test/query?param=value',
				'expected' => true
			],
			[
				'subject' => 'test/query?param=value&key=value',
				'expected' => true
			],
			[
				'subject' => 'not valid',
				'expected' => false
			],
			[
				'subject' => '',
				'expected' => false
			]
		];
	}

	#[Test]
	#[DataProvider('matchQueryProvider')]
	public function matchQuery(string $subject, bool $expected): void
	{
		$actual = Regex::matchQuery($subject);
		$this->assertEquals($expected, $actual);
	}
}
