<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Arrays;

class ArraysTest extends TestCase
{
	public static function cleanProvider(): array
	{
		return [
			[
				'list' => [' a ', ' b ', ' c '],
				'expected' => ['a', 'b', 'c']
			],
			[
				'list' => [],
				'expected' => []
			]
		];
	}

	#[Test]
	#[DataProvider('cleanProvider')]
	public function clean(array $list, array $expected): void
	{
		$actual = Arrays::clean($list);
		$this->assertEquals($expected, $actual);
	}

	public static function joinProvider(): array
	{
		return [
			[
				'list' => ['a', 'b', 'c'],
				'delimeter' => ',',
				'expected' => 'a,b,c'
			],
			[
				'list' => [],
				'delimeter' => ',',
				'expected' => ''
			]
		];
	}

	#[Test]
	#[DataProvider('joinProvider')]
	public function join(array $list, string $delimeter, string $expected): void
	{
		$actual = Arrays::join($list, $delimeter);
		$this->assertEquals($expected, $actual);
	}

	public static function flattenProvider(): array
	{
		return [
			[
				'list' => [['a', 'b'], ['c', 'd']],
				'expected' => ['a', 'b', 'c', 'd']
			],
			[
				'list' => [],
				'expected' => []
			]
		];
	}

	#[Test]
	#[DataProvider('flattenProvider')]
	public function flatten(array $list, array $expected): void
	{
		$actual = Arrays::flatten($list);
		$this->assertEquals($expected, $actual);
	}

	public static function mergeProvider(): array
	{
		return [
			[
				'lists' => [['a', 'b'], ['c', 'd']],
				'expected' => ['a', 'b', 'c', 'd']
			],
			[
				'lists' => [],
				'expected' => []
			]
		];
	}

	#[Test]
	#[DataProvider('mergeProvider')]
	public function merge(array $lists, array $expected): void
	{
		$actual = Arrays::merge(...$lists);
		$this->assertEquals($expected, $actual);
	}

	public static function removeEmptyProvider(): array
	{
		return [
			[
				'list' => ['a', '', 'b', ''],
				'expected' => [0 => 'a', 2 => 'b']
			],
			[
				'list' => [],
				'expected' => []
			]
		];
	}

	#[Test]
	#[DataProvider('removeEmptyProvider')]
	public function removeEmpty(array $list, array $expected): void
	{
		$actual = Arrays::removeEmpty($list);
		$this->assertEquals($expected, $actual);
	}

	public static function rekeyProvider(): array
	{
		return [
			[
				'records' => [
					['id' => 1, 'name' => 'Alice'],
					['id' => 2, 'name' => 'Bob']
				],
				'field' => 'id',
				'expected' => [
					1 => ['id' => 1, 'name' => 'Alice'],
					2 => ['id' => 2, 'name' => 'Bob']
				]
			],
			[
				'records' => [],
				'field' => 'id',
				'expected' => []
			],
			[
				'records' => [
					['id' => 1, 'name' => 'Alice'],
					['id' => 2, 'name' => 'Bob']
				],
				'field' => 'dummy',
				'expected' => [
					['id' => 1, 'name' => 'Alice'],
					['id' => 2, 'name' => 'Bob']
				]
			]
		];
	}

	#[Test]
	#[DataProvider('rekeyProvider')]
	public function rekey(array $records, string $field, array $expected): void
	{
		$actual = Arrays::rekey($records, $field);
		$this->assertEquals($expected, $actual);
	}
}
