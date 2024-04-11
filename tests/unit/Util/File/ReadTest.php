<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util\File;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\File;

class ReadTest extends TestCase
{
	public static function provider_test_file(): array
	{
		return [
			[
				'fullFilePath' => __DIR__ . '/read_test.txt',
				'expected' => 'This is a test file.'
			],
			[
				'fullFilePath' => __DIR__ . '/dir/read_test.txt',
				'expected' => null
			],
			[
				'fullFilePath' => '',
				'expected' => null
			]
		];
	}
	
	#[DataProvider('provider_test_file')]
	public function test_file(string $fullFilePath, ?string $expected): void
	{
		$this->assertEquals($expected, File::read($fullFilePath));
	}

	public static function provider_test_verifyFullFilePath(): array
	{
		return [
			[
				'fullFilePath' => '',
				'expected' => false
			],
			[
				'fullFilePath' => __DIR__ . '/dir/this_file_does_not_exist.txt',
				'expected' => false
			],
			[
				'fullFilePath' => __DIR__ . '/read_test.txt',
				'expected' => true
			]
		];
	}
	
	#[DataProvider('provider_test_verifyFullFilePath')]
	public function test_verifyFullFilePath(string $fullFilePath, bool $expected): void
	{
		$this->assertEquals($expected, File::isReadable($fullFilePath));
	}
}
