<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Base64;

class Base64Test extends TestCase
{
	public static function encodeUrlProvider(): array
	{
		return [
			'empty string' => [
				'',
				''
			],
			[
				'abc1',
				'YWJjMQ'
			]
		];
	}

	#[Test]
	#[DataProvider('encodeUrlProvider')]
	public function encodeUrl(string $string, string $expected): void
	{
		$actual = Base64::encodeUrl($string);
		$this->assertEquals($expected, $actual);
	}

	public static function encodeProvider(): array
	{
		return [
			'empty string' => [
				'',
				''
			],
			[
				'abc1',
				'YWJjMQ=='
			]
		];
	}

	#[DataProvider('encodeProvider')]
	public function encode(string $string, string $expected): void
	{
		$actual = Base64::encode($string);
		$this->assertEquals($expected, $actual);
	}

	public static function encodeUrlCharactersProvider(): array
	{
		return [
			'empty string' => [
				'',
				''
			],
			[
				'a+b/c=d',
				'a-b_cd'
			],
			[
				'+/=',
				'-_'
			]
		];
	}

	#[Test]
	#[DataProvider('encodeUrlCharactersProvider')]
	public function encodeUrlCharacters(string $string, string $expected): void
	{
		$actual = Base64::encodeUrlCharacters($string);
		$this->assertEquals($expected, $actual);
	}

	public static function decodeUrlProvider(): array
	{
		return [
			'empty string' => [
				'',
				''
			],
			[
				'YWJjMQ==',
				'abc1'
			]
		];
	}

	#[Test]
	#[DataProvider('decodeUrlProvider')]
	public function decodeUrl(string $string, string $expected): void
	{
		$actual = Base64::decodeUrl($string);
		$this->assertEquals($expected, $actual);
	}

	public static function decodeProvider(): array
	{
		return [
			'empty string' => [
				'',
				''
			],
			[
				'YWJjMQ==',
				'abc1'
			],
			[
				'YWJjMQ',
				'abc1'
			],
		];
	}

	#[Test]
	#[DataProvider('decodeProvider')]
	public function decode(string $string, string $expected): void
	{
		$actual = Base64::decode($string);
		$this->assertEquals($expected, $actual);
	}

	public static function decodeUrlCharactersProvider(): array
	{
		return [
			'empty string' => [
				'',
				''
			],
			[
				'-_',
				'+/'
			],
			[
				'a-b_c',
				'a+b/c'
			]
		];
	}

	#[Test]
	#[DataProvider('decodeUrlCharactersProvider')]
	public function decodeUrlCharacters(string $string, string $expected): void
	{
		$actual = Base64::decodeUrlCharacters($string);
		$this->assertEquals($expected, $actual);
	}
}
