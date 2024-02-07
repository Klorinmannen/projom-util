<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Json;

class JsonTest extends TestCase
{
	public static function provider_test_parseFile(): array
	{
		return [
			[
				'fullFilePath' => '',
				'expected' => []
			],
			[
				'fullFilePath' => __DIR__ . '/test_files/empty_text_file.txt',
				'expected' => []
			],
			[
				'fullFilePath' => __DIR__ . '/test_files/empty_json_file.json',
				'expected' => []
			],
			[
				'fullFilePath' => __DIR__ . '/test_files/json_file.json',
				'expected' => [
					'KEY' => 'value'
				]
			]
		];
	}

	#[DataProvider('provider_test_parseFile')]
	public function test_parseFile(string $fullFilepath, array $expected): void
	{
		$this->assertEquals($expected, Json::parseFile($fullFilepath));
	}

	public static function provider_test_verifyAndDecode(): array
	{
		return [
			'Empty string' => [
				'jsonString' => '',
				'asArray' => true,
				'expected' => null
			],
			'Malformed json' => [
				'jsonString' => '"key": "value"}',
				'asArray' => true,
				'expected' => null
			],
			'Proper json' => [
				'jsonString' => '{"key": "value"}',
				'asArray' => true,
				'expected' => [
					'key' => 'value'
				]
			],
			'Empty json' => [
				'jsonString' => '[]',
				'asArray' => true,
				'expected' => []
			],
		];
	}

	#[DataProvider('provider_test_verifyAndDecode')]
	public function test_verifyAndDecode(string $jsonString, bool $asArray, ?array $expected): void
	{
		$this->assertEquals($expected, Json::verifyAndDecode($jsonString, $asArray));
	}

	public static function provider_test_decode(): array
	{
		return [
			'Empty string' => [
				'jsonString' => '',
				'asArray' => true,
				'expected' => null
			],
			'Malformed json' => [
				'jsonString' => '"key": "value"}',
				'asArray' => true,
				'expected' => null
			],
			'Proper json' => [
				'jsonString' => '{"key": "value"}',
				'asArray' => true,
				'expected' => [
					'key' => 'value'
				]
			],
			'Empty json' => [
				'jsonString' => '[]',
				'asArray' => true,
				'expected' => []
			],
		];
	}

	#[DataProvider('provider_test_decode')]
	public function test_decode(string $jsonString, bool $asArray, ?array $expected): void
	{
		$this->assertEquals($expected, Json::decode($jsonString, $asArray));
	}

	public static function provider_test_verify(): array
	{
		return [
			[
				'jsonString' => '{"key": "value"',
				'expected' => false
			],
			[
				'jsonString' => '"key": "value"}',
				'expected' => false
			],
			[
				'jsonString' => '{{"key": "value"}',
				'expected' => false
			],
			[
				'jsonString' => '{\'key\': \'value\'}',
				'expected' => false
			],
			[
				'jsonString' => '',
				'expected' => false
			],
			[
				'jsonString' => '{"key": "value"}',
				'expected' => true
			],
			[
				'jsonString' => '[]',
				'expected' => true
			],
			[
				'jsonString' => '{}',
				'expected' => true
			]
		];
	}

	#[DataProvider('provider_test_verify')]
	public function test_verify(string $jsonString, bool $expected): void
	{
		$this->assertEquals($expected, Json::verify($jsonString));
	}

	public static function provider_test_encode(): array
	{
		return [
			'Bad value' => [
				'toEncode' => [
					'key' => acos(8)
				],
				'prettyPrint' => false,
				'expected' => null
			],
			'Good' => [
				'toEncode' => [
					'key' => 'value'
				],
				'prettyPrint' => false,
				'expected' => '{"key":"value"}'
			],
			'Empty' => [
				'toEncode' => [],
				'prettyPrint' => false,
				'expected' => '[]'
			],
			'Good pretty print' => [
				'toEncode' => [
					'key' => 'value'
				],
				'prettyPrint' => true,
				'expected' => "{\n    \"key\": \"value\"\n}"
			]
		];
	}

	#[DataProvider('provider_test_encode')]
	public function test_encode(array $toEncode, bool $prettyPrint, ?string $expected): void
	{
		$this->assertEquals($expected, Json::encode($toEncode, $prettyPrint));
	}
}
