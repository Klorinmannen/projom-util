<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Random;

class RandomTest extends TestCase
{
    public static function stringProvider(): array
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
                'length' => null,
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

    #[Test]
    #[DataProvider('stringProvider')]
    public function string(null|int $length, int $bytes, int $expectedLength): void
    {
        $string = Random::string($length, $bytes);
        $actual = strlen($string);
        $this->assertEquals($expectedLength, $actual);
    }

    public static function exceptionProvider(): array
    {
        return [
            [
                'length' => 0,
                'bytes' => 0
            ]
        ];
    }

    #[Test]
    #[DataProvider('exceptionProvider')]
    public function exception(int $length, int $bytes): void
    {
        $this->expectException(\ValueError::class);
        Random::string($length, $bytes);
    }
}
