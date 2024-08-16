<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Template;

class TemplateTest extends TestCase
{
    public static function bindProvider(): array
    {
        return [
            [
                'template' => 'Hello {{name}}!',
                'vars' => ['name' => 'John'],
                'expected' => 'Hello John!'
            ],
            [
                'template' => '{{greeting}} {{name}}!',
                'vars' => ['greeting' => 'Hi', 'name' => 'Doe'],
                'expected' => 'Hi Doe!'
            ],
            [
                'template' => 'No placeholders here.',
                'vars' => [],
                'expected' => 'No placeholders here.'
            ]
        ];
    }

    #[Test]
    #[DataProvider('bindProvider')]
    public function bind(string $template, array $vars, string $expected): void
    {
        $actual = Template::bind($template, $vars);
        $this->assertEquals($expected, $actual);
    }

    public static function templatedVarsProvider(): array
    {
        return [
            [
                'subjects' => ['name'],
                'expected' => ['{{name}}']
            ],
            [
                'subjects' => [
                    'greeting',
                    'name'
                ],
                'expected' => [
                    '{{greeting}}',
                    '{{name}}'
                ]
            ],
            [
                'subjects' => [],
                'expected' => []
            ]
        ];
    }

    #[Test]
    #[DataProvider('templatedVarsProvider')]
    public function templatedVars(array $subjects, array $expected): void
    {
        $actual = Template::templatedVars($subjects);
        $this->assertEquals($expected, $actual);
    }
}
