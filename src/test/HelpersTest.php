<?php

namespace Gam\Estafeta\Command\Test;

use Gam\Estafeta\Command\Helpers\Objects;

class HelpersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function objectTokenize(): void
    {
        $user = new DummyModel([
           'username' => 'foo', 'id' => '1231',  'color' => 'blue',
        ]);
        $expected = 'foo|1231|blue';
        self::assertEquals($expected, Objects::tokenize($user));
    }
}
