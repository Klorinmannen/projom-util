<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util\Math;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Math\Expression;

class ExpressionTest extends TestCase
{
    public static function provider_test_eval(): array
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

    #[DataProvider('provider_test_eval')]
    public function test_eval(string $expression, ?int $expected): void
    {
        $this->assertEquals($expected, Expression::eval($expression));
    }

    public static function provider_test_cleanExpression(): array
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

    #[DataProvider('provider_test_cleanExpression')]
    public function test_cleanExpression(string $expression, string $expected): void
    {
        $this->assertEquals($expected, Expression::cleanExpression($expression));
    }

    public static function provider_test_matchExpressionPattern(): array
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

    #[DataProvider('provider_test_matchExpressionPattern')]
    public function test_matchExpressionPattern(string $expression, array $expected): void
    {
        $this->assertEquals($expected, Expression::matchExpressionPattern($expression));
    }

    public static function provider_test_expression(): array
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

    #[DataProvider('provider_test_expression')]
    public function test_expression($operand_1, $operator, $operand_2, $expected): void
    {
        $this->assertEquals($expected, Expression::expression($operand_1, $operator, $operand_2));
    }

    public static function provider_test_postfixNotationStack(): array
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

    #[DataProvider('provider_test_postfixNotationStack')]
    public function test_postfixNotationStack(array $list, array $expected): void
    {
        $this->assertEquals($expected, Expression::postfixNotationStack($list));
    }
}
