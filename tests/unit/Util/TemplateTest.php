<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Projom\Util\Template;

class TemplateTest extends TestCase
{
    public static function provider_test_bind(): array
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

    #[DataProvider('provider_test_bind')]
    public function test_bind(string $template, array $vars, string $expected): void
    {
        $this->assertEquals($expected, Template::bind($template, $vars));
    }

    public static function provider_test_templatedVars(): array
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

    #[DataProvider('provider_test_templatedVars')]
    public function test_templatedVars(array $subjects, array $expected): void
    {
        $this->assertEquals($expected, Template::templatedVars($subjects));
    }
}
