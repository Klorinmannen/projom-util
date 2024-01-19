<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Xml;

class XmlTest extends TestCase
{
	public static function provider_test_encode(): array
	{
		return [
			[
				'toEncode' => [
					'root' => [
						'element1' => 'value1',
						'element2' => 'value2'
					]
				],
				'rootNodeName' => '',
				'expected' => '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
					. '<root><element1>value1</element1><element2>value2</element2></root>' . "\n"
			],
			[
				'toEncode' => [
					'child' => [
						'grandchild' => 'value'
					]
				],
				'rootNodeName' => 'root',
				'expected' => '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
					. '<root><child><grandchild>value</grandchild></child></root>' . "\n"
			],
			[
				'toEncode' => [],
				'rootNodeName' => '',
				'expected' => ''
			]
		];
	}

	#[DataProvider('provider_test_encode')]
	public function test_encode(array $toEncode, string $rootNodeName, string $expected): void
	{
		$this->assertEquals($expected, Xml::encode($toEncode, $rootNodeName));
	}
}
