<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Bools;

class BoolsTest extends TestCase
{
	public static function provider_test_toBoolean(): array
	{
		return [
			[
				'true',
				true
			],
			[
				'false',
				false
			],
			[
				'TRUE',
				true
			],
			[
				'',
				null
			],
			[
				'Trieu',
				null
			]
		];
	}
	
	#[DataProvider('provider_test_toBoolean')]
	public function test_toBoolean(string $boolString, ?bool $expected): void
	{
		$this->assertEquals($expected, Bools::toBoolean($boolString));
	}
}