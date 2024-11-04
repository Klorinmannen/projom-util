<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Json;

class JsonTest extends TestCase
{
	public static function parseFileProvider(): array
	{
		return [
			[
				'fullFilePath' => '',
				'expected' => null
			],
			[
				'fullFilePath' => __DIR__ . '/test_files/empty_text_file.txt',
				'expected' => null
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

	#[Test]
	#[DataProvider('parseFileProvider')]
	public function parseFile(string $fullFilePath, null|array $expected): void
	{
		$actual = Json::parseFile($fullFilePath);
		$this->assertEquals($expected, $actual);
	}

	public static function verifyAndDecodeProvider(): array
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

	#[Test]
	#[DataProvider('verifyAndDecodeProvider')]
	public function verifyAndDecode(string $jsonString, bool $asArray, null|array $expected): void
	{
		$actual = Json::verifyAndDecode($jsonString, $asArray);
		$this->assertEquals($expected, $actual);
	}

	public static function decodeProvider(): array
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

	#[Test]
	#[DataProvider('decodeProvider')]
	public function decode(string $jsonString, bool $asArray, null|array $expected): void
	{
		$actual = Json::decode($jsonString, $asArray);
		$this->assertEquals($expected, $actual);
	}

	public static function verifyProvider(): array
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

	#[Test]
	#[DataProvider('verifyProvider')]
	public function verify(string $jsonString, bool $expected): void
	{
		$actual = Json::verify($jsonString);
		$this->assertEquals($expected, $actual);
	}

	public static function encodeProvider(): array
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

	#[Test]
	#[DataProvider('encodeProvider')]
	public function encode(array $toEncode, bool $prettyPrint, null|string $expected): void
	{
		$actual = Json::encode($toEncode, $prettyPrint);
		$this->assertEquals($expected, $actual);
	}
}
