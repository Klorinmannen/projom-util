<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Base64;

class Base64Test extends TestCase
{
	public static function encodeUrlProvider(): array
	{
		return [
			'empty string' => [
				'', ''
			],
			[
				'abc1', 'YWJjMQ'
			]
		];
	}

	#[DataProvider('encodeUrlProvider')]
	public function test_encodeUrl(string $string, string $expected): void
	{
		$this->assertEquals($expected, Base64::encodeUrl($string));
	}

	public static function encodeProvider(): array
	{
		return [
			'empty string' => [
				'', ''
			],
			[
				'abc1', 'YWJjMQ=='
			]
		];
	}

	#[DataProvider('encodeProvider')]
	public function test_encode(string $string, string $expected): void
	{
		$this->assertEquals($expected, Base64::encode($string));
	}

	public static function encodeUrlCharactersProvider(): array
	{
		return [
			'empty string' => [
				'', ''
			],
			[
				'a+b/c=d', 'a-b_cd'
			],
			[
				'+/=', '-_'
			]
		];
	}

	#[DataProvider('encodeUrlCharactersProvider')]
	public function test_encodeUrlCharacters(string $string, string $expected): void
	{
		$this->assertEquals($expected, Base64::encodeUrlCharacters($string));
	}

	public static function decodeUrlProvider(): array
	{
		return [
			'empty string' => [
				'', ''
			],
			[
				'YWJjMQ==', 'abc1'
			]
		];
	}

	#[DataProvider('decodeUrlProvider')]
	public function test_decodeUrlProvider(string $string, string $expected): void
	{
		$this->assertEquals($expected, Base64::decodeUrl($string));
	}

	public static function decodeProvider(): array
	{
		return [
			'empty string' => [
				'', ''
			],
			[
				'YWJjMQ==', 'abc1'
			],
			[
				'YWJjMQ', 'abc1'
			],
		];
	}

	#[DataProvider('decodeProvider')]
	public function test_decode(string $string, string $expected): void
	{
		$this->assertEquals($expected, Base64::decode($string));
	}

	public static function decodeUrlCharactersProvider(): array
	{
		return [
			'empty string' => [
				'', ''
			],
			[
				'-_', '+/'
			],
			[
				'a-b_c', 'a+b/c'
			]
		];
	}

	#[DataProvider('decodeUrlCharactersProvider')]
	public function test_decodeUrlCharacters(string $string, string $expected): void
	{
		$this->assertEquals($expected, Base64::decodeUrlCharacters($string));
	}
}
