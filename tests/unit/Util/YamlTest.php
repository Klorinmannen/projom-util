<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Yaml;

class YamlTest extends TestCase
{
	public static function parseFileProvider(): array
	{
		return [
			'Empty fullFilePath' => [
				'fullFilePath' => '',
				'expected' => []
			],
			'Bad fullFilePath' => [
				'fullFilePath' => __DIR__ . '/dir/this_file_does_not_exist.txt',
				'expected' => []
			],
			'Yaml file' => [
				'fullFilePath' => __DIR__ . '/test_files/yaml_file.yaml',
				'expected' => [
					'KEY' => 'value'
				]
			]
		];
	}

	#[Test]
	#[DataProvider('parseFileProvider')]
	public function parseFile(string $fullFilePath, array $expected): void
	{
		$actual = Yaml::parseFile($fullFilePath);
		$this->assertEquals($expected, $actual);
	}
}
