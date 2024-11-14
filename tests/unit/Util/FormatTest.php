<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Projom\Util\Format;

class FormatTest extends TestCase
{
	public static function valueProvider(): array
	{
		return [
			['int', '123', 123],
			['float', '123.45', 123.45],
			['bool', 'true', true],
			['string', 123, '123'],
			['date', '2021-01-01 10:30:01', '2021-01-01'],
			['datetime', '2021-01-01 12:34:56', '2021-01-01 12:34:56'],
		];
	}

	#[Test]
	#[DataProvider('valueProvider')]
	public function value(string $type, mixed $value, mixed $expected): void
	{
		$actual = Format::value($value, $type);
		$this->assertEquals($expected, $actual);
	}

	public static function valuesProvider(): array
	{
		return [
			[
				[
					[Format::INT, '123'],
					[Format::FLOAT, '123.45'],
					[Format::BOOL, 'true'],
					[Format::STRING, 123],
					[Format::DATE, '2021-01-01 10:30:01'],
					[Format::DATETIME, '2021-01-01 12:34:56'],
				],
				[
					123,
					123.45,
					true,
					'123',
					'2021-01-01',
					'2021-01-01 12:34:56',
				],
			],
		];
	}

	#[Test]
	#[DataProvider('valuesProvider')]
	public function values(array $values, array $expected): void
	{
		$actual = Format::values($values);
		$this->assertEquals($expected, $actual);
	}
}