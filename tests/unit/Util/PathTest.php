<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Projom\Util\Path;

class PathTest extends TestCase
{
	public static function canonizeUnixProvider(): array
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

	#[Test]
	#[DataProvider('canonizeUnixProvider')]
	public function canonizeUnix(string $fullPath, string $expected): void
	{
		$actual = Path::canonizeUnix($fullPath);
		$this->assertEquals($expected, $actual);
	}

	public static function normalizeUnixProvider(): array
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

	#[Test]
	#[DataProvider('normalizeUnixProvider')]
	public function normalizeUnix(string $fullPath, $expected): void
	{
		$actual = Path::normalizeUnix($fullPath);
		$this->assertEquals($expected, $actual);
	}

	public static function absolutePathProvider(): array
	{
		return [
			[
				'fullFilePath' => __FILE__,
				'expected' => realpath(__FILE__)
			],
			[
				'fullFilePath' => '',
				'expected' => null
			],
			[
				'fullFilePath' => __DIR__ . '/../../../src/Util/Path.php',
				'expected' => realpath(__DIR__ . '/../../../src/Util/Path.php')
			],
			[
				'fullFilePath' => '../../../test/test.php',
				'expected' => null
			]
		];
	}

	#[Test]
	#[DataProvider('absolutePathProvider')]
	public function absolutePath(string $fullFilePath, null|string $expected): void
	{
		$actual = Path::absolute($fullFilePath);
		$this->assertEquals($expected, $actual);
	}
}
