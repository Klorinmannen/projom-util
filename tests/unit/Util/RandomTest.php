<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Random;

class RandomTest extends TestCase
{
    public static function provider_test_numberString(): array
    {
        return [
            [
                'length' => 10,
                'bytes' => 10,
                'expectedLength' => 10
            ],
            [
                'length' => 5,
                'bytes' => 10,
                'expectedLength' => 5
            ],
            [
                'length' => 0,
                'bytes' => 10,
                'expectedLength' => 20 // Hex string will have 2 characters per byte
            ],
            [
                'length' => 5,
                'bytes' => 5,
                'expectedLength' => 5
            ]
        ];
    }

    #[DataProvider('provider_test_numberString')]
    public function test_numberString(int $length, int $bytes, int $expectedLength): void
    {
        $result = Random::numberString($length, $bytes);
        $this->assertEquals($expectedLength, strlen($result));
    }

    public static function provider_test_numberString_exception(): array
    {
        return [
            [
                'length' => 0,
                'bytes' => 0
            ]
        ];
    }

    #[DataProvider('provider_test_numberString_exception')]
    public function test_numberString_exception(int $length, int $bytes): void
    {
        $this->expectException(\ValueError::class);
        Random::numberString($length, $bytes);
    }
}
