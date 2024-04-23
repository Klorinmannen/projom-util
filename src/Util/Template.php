<?php

declare(strict_types=1);

namespace Projom\Util;

class Template
{
    public static function bind(string $template, array $vars): string
    {
        $replacementVars = array_values($vars);
        $templatedVars = static::templatedVars(array_keys($vars));
        return str_replace($templatedVars, $replacementVars, $template);
    }

    public static function templatedVars(array $subjects, string $prefix = '{{', string $postfix = '}}'): array
    {
        $prefixedSubjects = preg_filter('/^/', $prefix, $subjects);
        return preg_filter('/$/', $postfix, $prefixedSubjects);
    }
}
