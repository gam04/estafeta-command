<?php

namespace Gam\Estafeta\Command\Test\Model\Reference;

use Gam\Estafeta\Command\Model\Reference;

class BeforeValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Reference::enablePrepareData();
    }

    public function testPrepareData(): void
    {
        $r = new Reference(
            betweenStreet: 'Entre Foo #12',
            andStreet: 'Y Bar #315',
            shed: 'sh #1',
            platform: 'pl #2',
            references: 'No. #12'
        );
        self::assertEquals('Entre Foo 12', $r->getBetweenStreet());
        self::assertEquals('Y Bar 315', $r->getAndStreet());
        self::assertEquals('sh 1', $r->getShed());
        self::assertEquals('pl 2', $r->getPlatform());
        self::assertEquals('No 12', $r->getReferences());
    }
}
