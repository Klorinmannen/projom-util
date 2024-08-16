<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Integers;

class IntegersTest extends TestCase
{

	public static function isIntProvider(): array
	{
		return [
			[
				1,
				true
			],
			[
				1.2,
				false
			],
			[
				'1',
				true
			],
			[
				'1.2',
				false
			],
			[
				'1001',
				true
			],
			[
				'1001.1001',
				false
			],
			[
				'0',
				true
			],
			[
				'-1001.1001',
				false
			],
			[
				-1,
				true
			],
			[
				'',
				false
			]
		];
	}

	#[Test]
	#[DataProvider('isIntProvider')]
	public function isInt(string|int|float $subject, bool $expected): void
	{
		$actual = Integers::isInt($subject);
		$this->assertEquals($expected, $actual);
	}


}
