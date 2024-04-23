<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Math;

class MathTest extends TestCase
{
    public static function provider_test_isSubset(): array
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

    #[DataProvider('provider_test_isSubset')]
    public function test_isSubset(array $subset, array $superset, bool $expected): void
    {
        $this->assertEquals($expected, Math::isSubsetKey($subset, $superset));
    }
}
