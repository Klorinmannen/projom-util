<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util\File;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\File;

class WriteTest extends TestCase
{
	public static function provider_test_file(): array
	{
		return [
			[
				'fullFilePath' => '',
				'data' => '',
				'expected' => false
			],
			[
				'fullFilePath' => __DIR__ . '/write_test.txt',
				'data' => 'Some string',
				'expected' => true
			],
			[
				'fullFilePath' => __DIR__ . '/write_test.txt',
				'data' => '',
				'expected' => true
			],
			[
				'fullFilePath' => __DIR__ . '/write_test.txt',
				'data' => [ 'Some', 'data' ],
				'expected' => true
			]
		];
	}
	
	#[DataProvider('provider_test_file')]
	public function test_create(string $fullFilePath, mixed $data, bool $expected): void
	{
		$this->assertEquals($expected, File::write($fullFilePath, $data));
	}

	public static function provider_test_appendFile(): array
	{
		return [
			[
				'fullFilePath' => '',
				'data' => 'Some string',
				'expected' => false
			],
			[
				'fullFilePath' => __DIR__ . '/dir/this_file_does_not_exist.txt',
				'data' => 'Some string',
				'expected' => false
			],
			[
				'fullFilePath' => __DIR__ . '/write_test.txt',
				'data' => 'Some string',
				'expected' => true
			],
			[
				'fullFilePath' => __DIR__ . '/write_test.txt',
				'data' => [ 'Some', 'data' ],
				'expected' => true
			]
		];
	}
	
	#[DataProvider('provider_test_appendFile')]
	public function test_append(string $fullFilePath, mixed $data, bool $expected): void
	{
		$this->assertEquals($expected, File::appendFile($fullFilePath, $data));
	}

	public static function provider_test_verifyFullFilePath(): array
	{
		return [
			[
				'fullFilePath' => __DIR__ . '/write_test.txt',
				'expected' => true
			],
			[
				'fullFilePath' => '',
				'expected' => false
			],
			[
				'fullFilePath' => __DIR__ . '/dir/this_file_does_not_exist.txt',
				'expected' => false
			]
		];
	}
	
	#[DataProvider('provider_test_verifyFullFilePath')]
	public function test_verifyFullFilePath(string $fullFilePath, bool $expected): void
	{
		$this->assertEquals($expected, File::isWriteable($fullFilePath));
	}
}