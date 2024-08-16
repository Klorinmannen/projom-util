<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util\Math;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Math\Expression;

class ExpressionTest extends TestCase
{
    public static function evalProvider(): array
    {
        return [
            [
                'expression' => '2 + 3',
                'expected' => 5
            ],
            [
                'expression' => '6 - 4',
                'expected' => 2
            ],
            [
                'expression' => '2 * 3',
                'expected' => 6
            ],
            [
                'expression' => '6 / 3',
                'expected' => 2
            ],
            [
                'expression' => ' ',
                'expected' => null
            ]
        ];
    }

    #[Test]
    #[DataProvider('evalProvider')]
    public function eval(string $expression, ?int $expected): void
    {
        $actual = Expression::eval($expression);
        $this->assertEquals($expected, $actual);
    }

    public static function cleanExpressionProvider(): array
    {
        return [
            [
                'expression' => '  2 + 3  ',
                'expected' => '2+3'
            ],
            [
                'expression' => '6 -  4 ',
                'expected' => '6-4'
            ],
            [
                'expression' => '  ',
                'expected' => ''
            ]
        ];
    }

    #[Test]
    #[DataProvider('cleanExpressionProvider')]
    public function cleanExpression(string $expression, string $expected): void
    {
        $actual = Expression::cleanExpression($expression);
        $this->assertEquals($expected, $actual);
    }

    public static function matchExpressionPatternProvider(): array
    {
        return [
            [
                'expression' => '2+3',
                'expected' => ['2', '+', '3']
            ],
            [
                'expression' => '6-4',
                'expected' => ['6', '-', '4']
            ],
            [
                'expression' => '',
                'expected' => []
            ]
        ];
    }

    #[Test]
    #[DataProvider('matchExpressionPatternProvider')]
    public function matchExpressionPattern(string $expression, array $expected): void
    {
        $actual = Expression::matchExpressionPattern($expression);
        $this->assertEquals($expected, $actual);
    }

    public static function expressionProvider(): array
    {
        return [
            [
                'operand_1' => 2,
                'operator' => '+',
                'operand_2' => 3,
                'expected' => 5
            ],
            [
                'operand_1' => 1,
                'operator' => '-',
                'operand_2' => 1,
                'expected' => 0
            ],
            [
                'operand_1' => 10,
                'operator' => '*',
                'operand_2' => 0.5,
                'expected' => 5
            ],
            [
                'operand_1' => 10,
                'operator' => '/',
                'operand_2' => 5,
                'expected' => 2
            ]
        ];
    }

    #[Test]
    #[DataProvider('expressionProvider')]
    public function expression(int|float $operand_1, string $operator, int|float $operand_2, int $expected): void
    {
        $actual = Expression::expression($operand_1, $operator, $operand_2);
        $this->assertEquals($expected, $actual);
    }

    public static function postfixNotationStackProvider(): array
    {
        return [
            [
                'list' => ['2', '+', '3'],
                'expected' => ['2', '3', '+']
            ],
            [
                'list' => ['2', '+', '3', '-', '1'],
                'expected' => ['2', '3', '+', '1', '-',]
            ],
        ];
    }

    #[Test]
    #[DataProvider('postfixNotationStackProvider')]
    public function postfixNotationStack(array $list, array $expected): void
    {
        $actual = Expression::postfixNotationStack($list);
        $this->assertEquals($expected, $actual);
    }
}
