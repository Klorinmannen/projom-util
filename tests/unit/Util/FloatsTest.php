<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Floats;

class FloatsTest extends TestCase
{
	public static function provider_test_matchPattern(): array
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
	
	#[DataProvider('provider_test_matchPattern')]
	public function test_matchPattern(float $subject, bool $expected): void
	{
		$this->assertEquals($expected, Floats::matchPattern($subject));
	}
}