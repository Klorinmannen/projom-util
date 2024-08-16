<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Dir;

class DirTest extends TestCase
{
	#[Test]
	public function systemPath(): void
	{
		$this->assertNotEmpty(Dir::systemPath());
		$this->assertEmpty(Dir::systemPath('not_src'));
	}

	public static function parseProvider(): array
	{
		return [
			[
				'fullDirPath' => __DIR__ . '/test_files',
				'expected' => [
					'json_file' => ['KEY' => 'value'],
					'yaml_file' => ['KEY' => 'value'],
					'text_file' => [0 => 'A text file.'],
					'empty_text_file' => [0 => ''],
					'empty_json_file' => []
				]
			]
		];
	}

	#[Test]
	#[DataProvider('parseProvider')]
	public function parse(string $fullDirPath, array $expected): void
	{
		$actual = Dir::parse($fullDirPath);
		$this->assertEquals($expected, $actual);
	}

	public static function isReadableProvider(): array
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

	#[Test]
	#[DataProvider('isReadableProvider')]
	public function isReadables(string $value, bool $expected): void
	{
		$actual = Dir::isReadable($value);
		$this->assertEquals($expected, $actual);
	}

	public static function cleanFileListProvider(): array
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

	#[Test]
	#[DataProvider('cleanFileListProvider')]
	public function cleanFileList(array $value, array $expected): void
	{
		$actual = Dir::cleanFileList($value);
		$this->assertEqualsCanonicalizing($expected, $actual);
	}

	public static function prependfullDirPathProvider(): array
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

	#[Test]
	#[DataProvider('prependfullDirPathProvider')]
	public function prependfullDirPath(string $fullDirPath, array $fileList, array $expected): void
	{
		$actual = Dir::prependfullDirPath($fullDirPath, $fileList);
		$this->assertEquals($expected, $actual);
	}
}
