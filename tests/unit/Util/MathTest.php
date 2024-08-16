<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Math;

class MathTest extends TestCase
{
    public static function isSubsetKeyProvider(): array
    {
        return [
            [
                'subset' => [
                    'key1' => 'value1',
                    'key2' => 'value2'
                ],
                'superset' => [
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3'
                ],
                'expected' => true
            ],
            [
                'subset' => [
                    'key1' => 'value1'
                ],
                'superset' => [
                    'key1' => 'value1',
                    'key2' => 'value2'
                ],
                'expected' => true
            ],
            [
                'subset' => [
                    'key1' => 'value1',
                    'key2' => 'value2'
                ],
                'superset' => [
                    'key1' => 'value1'
                ],
                'expected' => false
            ],
            [
                'subset' => [],
                'superset' => [
                    'key1' => 'value1'
                ],
                'expected' => true
            ],
            [
                'subset' => [
                    'key1' => 'value1'
                ],
                'superset' => [],
                'expected' => false
            ]
        ];
    }

    #[Test]
    #[DataProvider('isSubsetKeyProvider')]
    public function isSubsetKey(array $subset, array $superset, bool $expected): void
    {
        $actual = Math::isSubsetKey($subset, $superset);
        $this->assertEquals($expected, $actual);
    }

    public static function clampProvider(): array
    {
        return [
            [
                'min' => 0,
                'max' => 10,
                'value' => 5,
                'expected' => 5
            ],
            [
                'min' => 0,
                'max' => 10,
                'value' => -5,
                'expected' => 0
            ],
            [
                'min' => 0,
                'max' => 10,
                'value' => 15,
                'expected' => 10
            ],
            [
                'min' => 0,
                'max' => 10,
                'value' => 0,
                'expected' => 0
            ],
            [
                'min' => 0,
                'max' => 10,
                'value' => 10,
                'expected' => 10
            ]
        ];
    }

    #[Test]
    #[DataProvider('clampProvider')]
    public function clamp(float|int $min, float|int $max, float|int $value, float|int $expected): void
    {
        $actual = Math::clamp($min, $max, $value);
        $this->assertEquals($expected, $actual);
    }
}
