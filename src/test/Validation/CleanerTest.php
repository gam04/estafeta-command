<?php

namespace Gam\Estafeta\Command\Test\Validation;

use Gam\Estafeta\Command\Validation\Cleaner;
use PHPUnit\Framework\TestCase;

class CleanerTest extends TestCase
{
    public function testArrayCallback(): void
    {
        $callbacks = [
            'reference' => [
                function ($content) {
                    return substr($content, 0, 5);
                },
                [Cleaner::class, 'ofAlphanumeric'],
            ],
        ];
        $clean = Cleaner::arrayCallback($callbacks, ['reference' => 'RE-PLACE']);
        self::assertEquals('REPL', $clean['reference']);
    }

    public function testOfAlphanumeric(): void
    {
        self::assertEquals('FOO12_', Cleaner::ofAlphanumeric(".,;:#*^FOO12{}¡!'\"¿?``-_()<ô>"));
    }

    public function testOfValidDescription(): void
    {
        self::assertEquals('FOO12', Cleaner::ofValidDescription("FOO12{}¡!'\"¿?``-_()<ô>"));
    }
}
