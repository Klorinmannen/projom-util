<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\File;

class FileTest extends TestCase
{
	public static function provider_test_IsReadable(): array
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
	
	#[DataProvider('provider_test_IsReadable')]
	public function test_method_name(string $fullFilePath, bool $expected): void
	{
		$this->assertEquals($expected, File::isReadable($fullFilePath));
	}

	public static function provider_test_fullName(): array
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
	
	#[DataProvider('provider_test_fullName')]
	public function test_fullName(string $fullFilePath, string $expected): void
	{
		$this->assertEquals($expected, File::fullName($fullFilePath));
	}

	public static function provider_test_name(): array
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
	
	#[DataProvider('provider_test_name')]
	public function test_name(string $fullFilePath, string $expected): void
	{
		$this->assertEquals($expected, File::name($fullFilePath));
	}

	public static function provider_test_extension(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => 'php'
			],
			[
				'fullFilePath' => '',
				'expected' => ''
			]
		];
	}
	
	#[DataProvider('provider_test_extension')]
	public function test_extension(string $fullFilePath, string $expected): void
	{
		$this->assertEquals($expected, File::extension($fullFilePath));
	}

	public static function provider_test_removeExtension(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => __DIR__ . DIRECTORY_SEPARATOR . 'FileTest'
			],
			[
				'fullFilePath' => '',
				'expected' => ''
			]
		];
	}
	
	#[DataProvider('provider_test_removeExtension')]
	public function test_removeExtension(string $fullFilePath, string $expected): void
	{
		$this->assertEquals($expected, File::removeExtension($fullFilePath));
	}
	
	public static function provider_canonizeUnixPath(): array
	{
		return [
			[
				'fullPath' => 'some/file/path/file.php',
				'expected' => 'some/file/path/file'
			],
			[
				'fullPath' => 'some\file\path\file.php',
				'expected' => 'some/file/path/file'
			]
		];
	}
	
	#[DataProvider('provider_canonizeUnixPath')]
	public function test_canonizeUnixPath(string $fullPath, string $expected): void
	{
		$this->assertEquals($expected, File::canonizeUnixPath($fullPath));
	}

	public static function provider_test_normalizeUnixPath(): array
	{
		return [
			'windows path' => [
				'fullPath' => 'some\file\path',
				'expected' => 'some/file/path'
			],
			'unix path' => [
				'fullPath' => 'some/file/path',
				'expected' => 'some/file/path'
			],
			'empty path' => [
				'fullPath' => '',
				'expected' => ''
			]
		];
	}
	
	#[DataProvider('provider_test_normalizeUnixPath')]
	public function test_normalizeUnixPath(string $fullPath, $expected): void
	{
		$this->assertEquals($expected, File::normalizeUnixPath($fullPath));
	}

	public static function provider_test_parse(): array
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
				'expected' => []
			]
		];
	}
	
	#[DataProvider('provider_test_parse')]
	public function test_parse(string $fullFilePath, array $expected): void
	{
		$this->assertEquals($expected, File::parse($fullFilePath));
	}

	public static function provider_test_parseList(): array
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
	
	#[DataProvider('provider_test_parseList')]
	public function test_parseList(array $fileList, array $expected): void
	{
		$this->assertEquals($expected, File::parseList($fileList));
	}
}