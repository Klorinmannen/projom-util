<?php

declare(strict_types=1);

namespace Projom\Util\Math;

class Expression
{
    const OPERATORS = ['+', '-', '*', '/'];
    const PATTERN = '/\d+|\+|\*|-|\/|\(|\)/';

    public static function eval(string $expression): ?int
    {
        if (!$expression = static::cleanExpression($expression))
            return null;

        if (!$list = static::matchExpressionPattern($expression))
            return null;

        $stack = [];
        $postfixNotationStack = static::postfixNotationStack($list);
        foreach ($postfixNotationStack as $item) {

            switch (is_numeric($item)) {

                case true:
                    $stack[] = $item;
                    break;

                case false:
                    $operand_1 = array_shift($stack);
                    $operator = $item;
                    $operand_2 = array_shift($stack);

                    $result = static::expression($operand_1, $operator, $operand_2);

                    $stack[] = $result;
                    break;
            }
        }

        return array_shift($stack);
    }

    public static function cleanExpression(string $expression): string
    {
        $expression = trim($expression);
        $expression = str_replace(' ', '', $expression);
        return $expression;
    }

    public static function matchExpressionPattern(string $expression): array
    {
        preg_match_all(static::PATTERN, $expression, $matches);
        $list = $matches[0] ?? [];
        return $list;
    }

    public static function expression(string|int|float $operand_1, string|int|float $operator, string|int|float $operand_2): string|int|float
    {
        return match ($operator) {
            '+' => $operand_1 + $operand_2,
            '-' => $operand_1 - $operand_2,
            '*' => $operand_1 * $operand_2,
            '/' => $operand_1 / $operand_2,
        };
    }

    public static function postfixNotationStack(array $list): array
    {
        $stack = [];
        $operator = '';
        foreach ($list as $item) {

            if (is_numeric($item)) {

                $stack[] = $item;
                if ($operator !== '') {
                    $stack[] = $operator;
                    $operator = '';
                }

                continue;
            }

            if (in_array($item, static::OPERATORS))
                $operator = $item;
        }

        return $stack;
    }
}
