<?php

declare(strict_types=1);

namespace Projom\Util;

class Math
{
    public static function isSubset(
        array $subset,
        array $superset
    ): bool {
        return count(array_diff_key($subset, $superset)) === 0;
    }
}
