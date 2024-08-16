<?php

declare(strict_types=1);

namespace Projom\Util;

class Math
{
    public static function isSubsetKey(array $subset, array $superset): bool
    {
        return count(array_diff_key($subset, $superset)) === 0;
    }

    public static function clamp(float|int $min, float|int $max, float|int $value): float|int
    {
        if ($value < $min)
            return $min;

        if ($value > $max)
            return $max;

        return $value;
    }
}
