<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Dir;

class DirTest extends TestCase
{
	public function test_systemPath(): void
	{
		$this->assertNotEmpty(Dir::systemPath());
		$this->assertEmpty(Dir::systemPath('not_src'));
	}

	public static function provider_test_parse(): array
	{
		return [
			[
				'fullDirPath' => __DIR__ . '/test_files',
				'expected' => [ 
					'json_file' => [ 'KEY' => 'value' ], 
					'yaml_file' => [ 'KEY' => 'value' ],
					'text_file' => [ 0 => 'A text file.' ],
					'empty_text_file' => [ 0 => '' ],
					'empty_json_file' => []
				]
			]
		];
	}
	
	#[DataProvider('provider_test_parse')]
	public function test_parse(string $fullDirPath, array $expected): void
	{
		$this->assertEquals($expected, Dir::parse($fullDirPath));
	}

	public static function provider_test_isReadable(): array
	{
		return [
			'Directory' => [
				'value' => __DIR__,
				'expected' => true
			],
			'Empty' => [
				'value' => '',
				'expected' => false
			],
			'File' => [
				'value' => __FILE__,
				'expected' => false
			]
		];
	}
	
	#[DataProvider('provider_test_isReadable')]
	public function test_isReadable(string $value, bool $expected): void
	{
		$this->assertEquals($expected, Dir::isReadable($value));
	}

	public static function provider_test_cleanFileList(): array
	{
		return [
			[
				'value' => [
					'.',
					'..',
					'A file name',
					'Another file name'
				],
				'expected' => [
					'A file name',
					'Another file name'
				]
			]
		];
	}
	
	#[DataProvider('provider_test_cleanFileList')]
	public function test_cleanFileList(array $value, array $expected): void
	{
		$this->assertEqualsCanonicalizing($expected, Dir::cleanFileList($value));
	}

	public static function provider_test_prependFullDirPath(): array
	{
		return [
			[
				'fullDirPath' => __DIR__,
				'fileList' => [ 
					'file1', 
					'file2', 
					'file3' 
				],
				'expected' => [ 
					__DIR__ . DIRECTORY_SEPARATOR . 'file1',
					__DIR__ . DIRECTORY_SEPARATOR . 'file2',
					__DIR__ . DIRECTORY_SEPARATOR . 'file3'
				]
			]
		];
	}
	
	#[DataProvider('provider_test_prependFullDirPath')]
	public function test_prependFullDirPath(string $fullDirPath, array $fileList, array $expected): void
	{
		$this->assertEquals($expected, Dir::prependfullDirPath($fullDirPath, $fileList));
	}
}