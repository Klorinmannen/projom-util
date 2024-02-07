<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Validate;

class ValidateTest extends TestCase
{
	public static function provider_test_float(): array
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

	#[DataProvider('provider_test_float')]
	public function test_float(float $float, bool $expected): void
	{
		$this->assertEquals($expected, Validate::float($float));
	}

	public static function provider_test_int(): array
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

	#[DataProvider('provider_test_int')]
	public function test_int(int $int, bool $expected): void
	{
		$this->assertEquals($expected, Validate::int($int));
	}

	public static function provider_test_id(): array
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

	#[DataProvider('provider_test_id')]
	public function test_id(int $id, bool $expected): void
	{
		$this->assertEquals($expected, Validate::id($id));
	}

	public static function provider_test_string(): array
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

	#[DataProvider('provider_test_string')]
	public function test_string(string $string, bool $expected): void
	{
		$this->assertEquals($expected, Validate::textString($string));
	}

	public static function provider_test_query(): array
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

	#[DataProvider('provider_test_query')]
	public function test_query(string $query, bool $expected): void
	{
		$this->assertEquals($expected, Validate::queryString($query));
	}
}
