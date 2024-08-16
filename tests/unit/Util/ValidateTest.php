<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Validate;

class ValidateTest extends TestCase
{
	public static function floatProvider(): array
	{
		return [
			[
				'float' => 1.1,
				'expected' => true
			],
			[
				'float' => -1.1,
				'expected' => true
			],
			[
				'float' => 0.0,
				'expected' => true
			]
		];
	}

	#[Test]
	#[DataProvider('floatProvider')]
	public function float(float $float, bool $expected): void
	{
		$actual = Validate::float($float);
		$this->assertEquals($expected, $actual);
	}

	public static function intProvider(): array
	{
		return [
			[
				'int' => 1,
				'expected' => true
			],
			[
				'int' => 0,
				'expected' => true
			],
			[
				'int' => -1,
				'expected' => true
			]
		];
	}

	#[Test]
	#[DataProvider('intProvider')]
	public function int(int $int, bool $expected): void
	{
		$actual = Validate::int($int);
		$this->assertEquals($expected, $actual);
	}

	public static function idProvider(): array
	{
		return [
			[
				'id' => 1,
				'expected' => true
			],
			[
				'id' => 99910,
				'expected' => true
			],
			[
				'id' => 0,
				'expected' => false
			]
		];
	}

	#[Test]
	#[DataProvider('idProvider')]
	public function id(int $id, bool $expected): void
	{
		$actual = Validate::id($id);
		$this->assertEquals($expected, $actual);
	}

	public static function textStringProvider(): array
	{
		return [
			[
				'string' => 'abc',
				'expected' => true
			],
			[
				'string' => '  ',
				'expected' => true
			],
			[
				'string' => '123',
				'expected' => true
			],
			[
				'string' => '',
				'expected' => true
			],
			[
				'string' => 'Yes!',
				'expected' => true
			],
			[
				'string' => '!)([}!?+-.;"#',
				'expected' => true
			]
		];
	}

	#[Test]
	#[DataProvider('textStringProvider')]
	public function textString(string $string, bool $expected): void
	{
		$actual = Validate::textString($string);
		$this->assertEquals($expected, $actual);
	}

	public static function queryStringProvider(): array
	{
		return [
			[
				'query' => '?key=value&key2=value2',
				'expected' => true
			],
			[
				'query' => '',
				'expected' => false
			]
		];
	}

	#[Test]
	#[DataProvider('queryStringProvider')]
	public function test_query(string $query, bool $expected): void
	{
		$actual = Validate::queryString($query);
		$this->assertEquals($expected, $actual);
	}
}
