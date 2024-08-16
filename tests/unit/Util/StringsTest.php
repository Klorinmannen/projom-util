<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Strings;

class StringsTest extends TestCase
{
    public static function toArrayProvider(): array
    {
        return [
            [
                'subject' => 'a,b,c',
                'delimeter' => ',',
                'expected' => ['a', 'b', 'c']
            ],
            [
                'subject' => 'a,b,c',
                'delimeter' => ' ',
                'expected' => ['a,b,c']
            ],
            [
                'subject' => 'a,b,c',
                'delimeter' => 'b',
                'expected' => ['a,', ',c']
            ],
            [
                'subject' => '',
                'delimeter' => ',',
                'expected' => []
            ]
        ];
    }

    #[Test]
    #[DataProvider('toArrayProvider')]
    public function toArray(string $subject, string $delimeter, array $expected): void
    {
        $actual = Strings::toArray($subject, $delimeter);
        $this->assertEquals($expected, $actual);
    }

    public static function cleanProvider(): array
    {
        return [
            [
                'subject' => ' a b c ',
                'remove' => ' ',
                'expected' => 'abc'
            ],
            [
                'subject' => ' a b c ',
                'remove' => 'b',
                'expected' => ' a  c '
            ],
            [
                'subject' => ' a b c ',
                'remove' => 'd',
                'expected' => ' a b c '
            ],
            [
                'subject' => '',
                'remove' => ' ',
                'expected' => ''
            ],
            [
                'subject' => ' a b c ',
                'remove' => '',
                'expected' => ' a b c '
            ]
        ];
    }

    #[Test]
    #[DataProvider('cleanProvider')]
    public function clean(string $subject, string $remove, string $expected): void
    {
        $actual = Strings::clean($subject, $remove);
        $this->assertEquals($expected, $actual);
    }

    public static function splitProvider(): array
    {
        return [
            [
                'subject' => 'a,b,c',
                'delimeter' => ',',
                'expected' => ['a', 'b', 'c']
            ],
            [
                'subject' => 'a,b,c',
                'delimeter' => ' ',
                'expected' => ['a,b,c']
            ],
            [
                'subject' => 'a,b,c',
                'delimeter' => 'b',
                'expected' => ['a,', ',c']
            ],
            [
                'subject' => '',
                'delimeter' => ',',
                'expected' => []
            ]
        ];
    }

    #[Test]
    #[DataProvider('splitProvider')]
    public function split(string $subject, string $delimeter, array $expected): void
    {
        $actual = Strings::split($subject, $delimeter);
        $this->assertEquals($expected, $actual);
    }
}
