<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Yaml;

class YamlTest extends TestCase
{
	public static function provider_test_parseFile(): array
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
	
	#[DataProvider('provider_test_parseFile')]
	public function test_method_name(string $fullFilePath, array $expected): void
	{
		$this->assertEquals($expected, Yaml::parseFile($fullFilePath));
	}
}