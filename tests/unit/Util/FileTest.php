<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\File;

class FileTest extends TestCase
{
	public static function isReadableProvider(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => true
			],
			[
				'fullFilePath' => __DIR__,
				'expected' => false
			],
			[
				'fullFilePath' => '',
				'expected' => false
			]
		];
	}

	#[Test]
	#[DataProvider('isReadableProvider')]
	public function isReadables(string $fullFilePath, bool $expected): void
	{
		$actual = File::isReadable($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function fullNameProvider(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => 'FileTest.php'
			],
			[
				'fullFilePath' => '',
				'expected' => ''
			]
		];
	}

	#[Test]
	#[DataProvider('fullNameProvider')]
	public function fullName(string $fullFilePath, string $expected): void
	{
		$actual	= File::name($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function nameProvider(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => 'FileTest'
			],
			[
				'fullFilePath' => '',
				'expected' => ''
			]
		];
	}

	#[Test]
	#[DataProvider('nameProvider')]
	public function names(string $fullFilePath, string $expected): void
	{
		$actual = File::filename($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function extensionProvider(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => 'php'
			],
			[
				'fullFilePath' => '',
				'expected' => ''
			],
			[
				'fullFilePath' => 'filename.tar.gz',
				'expected' => 'gz'
			],
			[
				'fullFilePath' => 'filename',
				'expected' => ''
			],
			[
				'fullFilePath' => 'filename.',
				'expected' => ''
			],
			[
				'fullFilePath' => 'filename.yml',
				'expected' => 'yml'
			]
		];
	}

	#[Test]
	#[DataProvider('extensionProvider')]
	public function extension(string $fullFilePath, string $expected): void
	{
		$actual = File::extension($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function removeExtensionProvider(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => __DIR__ . DIRECTORY_SEPARATOR . 'FileTest'
			],
			[
				'fullFilePath' => '',
				'expected' => ''
			],
			[
				'fullFilePath' => 'filename.tar.gz',
				'expected' => 'filename.tar'
			],
			[
				'fullFilePath' => 'filename',
				'expected' => 'filename'
			],
			[
				'fullFilePath' => 'filename.',
				'expected' => 'filename'
			],
			[
				'fullFilePath' => 'filename.yml',
				'expected' => 'filename'
			]
		];
	}

	#[Test]
	#[DataProvider('removeExtensionProvider')]
	public function removeExtension(string $fullFilePath, string $expected): void
	{
		$actual = File::removeExtension($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	#[Test]
	public function directory(): void
	{
		$fullFilePath = __FILE__;
		$expected = __DIR__;
		$actual = File::directory($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function parseProvider(): array
	{
		return [
			[
				'fullFilePath' => __DIR__ . '/test_files/json_file.json',
				'expected' => [
					'KEY' => 'value'
				]
			],
			[
				'fullFilePath' => '',
				'expected' => []
			],
			[
				'fullFilePath' => 'some/file/path/file.yaml',
				'expected' => []
			],
			[
				'fullFilePath' => 'some/file/path/file.json',
				'expected' => null
			]
		];
	}

	#[Test]
	#[DataProvider('parseProvider')]
	public function parse(string $fullFilePath, null|array $expected): void
	{
		$actual = File::parse($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function parseListProvider(): array
	{
		return [
			[
				'fileList' => [
					'',
					'some/file/path/file.json'
				],
				'expected' => []
			],
			[
				'fileList' => [
					__DIR__ . '/test_files/yaml_file.yaml',
					__DIR__ . '/test_files/json_file.json'
				],
				'expected' => [
					'yaml_file' => [
						'KEY' => 'value'
					],
					'json_file' => [
						'KEY' => 'value'
					]
				]
			]
		];
	}

	#[Test]
	#[DataProvider('parseListProvider')]
	public function parseList(array $fileList, array $expected): void
	{
		$actual = File::parseList($fileList);
		$this->assertEquals($expected, $actual);
	}
}
