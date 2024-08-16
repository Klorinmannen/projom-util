<?php

declare(strict_types=1);

namespace Projom\Util;

class Debug
{
    public static function sql(string $sql, string $lb = "\n"): string
    {
        $output = preg_split(
            '/(SELECT|FROM|WHERE|INSERT INTO|VALUES|INNER JOIN|ON|LEFT JOIN|RIGHT JOIN)/',
            $sql,
            -1,
            \PREG_SPLIT_NO_EMPTY | \PREG_SPLIT_DELIM_CAPTURE
        );
        return implode($lb, $output);
    }

    public static function asString(array $subject): string
    {
        return var_export($subject);
    }

    public static function html($subject): void
    {
        echo '<pre>';
        print_r($subject);
        echo '</pre>';
    }

    public static function html_dump($subject): void
    {
        echo '<pre>';
        var_dump($subject);
        echo '</pre>';
    }
}
