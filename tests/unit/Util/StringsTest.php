<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Strings;

class StringsTest extends TestCase
{
    public static function provider_test_sanitize(): array
    {
        return [
            [
                'string' => 'helloWorld!',
                'expected' => 'helloWorld'
            ],
            [
                'string' => 'special@#$%characters',
                'expected' => 'specialcharacters'
            ],
            [
                'string' => '',
                'expected' => ''
            ]
        ];
    }

    #[DataProvider('provider_test_sanitize')]
    public function test_sanitize(string $string, string $expected): void
    {
        $this->assertEquals($expected, Strings::sanitize($string));
    }

    public static function provider_test_matchTextPattern(): array
    {
        return 
        [
            [
                'subject' => 'test',
                'expected' => true
            ],
            [
                'subject' => 'with space',
                'expected' => true
            ],
            [
                'subject' => '123',
                'expected' => true
            ],
            [
                'subject' => '',
                'expected' => true
            ]
        ];
    }

    #[DataProvider('provider_test_matchTextPattern')]
    public function test_matchPattern(string $subject, bool $expected): void
    {
        $this->assertEquals($expected, Strings::matchTextPattern($subject));
    }

    public static function provider_test_matchQueryPattern(): array
    {
        return 
        [
            [
                'subject' => 'test/query?param=value',
                'expected' => true
            ],
            [
                'subject' => 'test/query?param=value&key=value',
                'expected' => true
            ],
            [
                'subject' => 'not valid',
                'expected' => false
            ],
            [
                'subject' => '',
                'expected' => false
            ]
        ];
    }

    #[DataProvider('provider_test_matchQueryPattern')]
    public function test_matchQueryPattern(string $subject, bool $expected): void
    {
        $this->assertEquals($expected, Strings::matchQueryPattern($subject));
    }
}
