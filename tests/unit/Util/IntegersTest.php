<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Integers;

class IntegersTest extends TestCase
{
	public static function provider_test_matchPattern(): array
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

	#[DataProvider('provider_test_matchPattern')]
	public function test_matchPattern(int $subject, bool $expected): void
	{
		$this->assertEquals($expected, Integers::matchPattern($subject));
	}

	public static function provider_test_matchIdPattern(): array
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

	#[DataProvider('provider_test_matchIdPattern')]
	public function test_matchIdPattern(int $subject, bool $expected): void
	{
		$this->assertEquals($expected, Integers::matchIdPattern($subject));
	}
}
