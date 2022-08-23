<?php

namespace Gam\Estafeta\Command\Test\Model\Package;

use Gam\Estafeta\Command\Model\Dimension;
use Gam\Estafeta\Command\Model\Package;

class BeforeValidationTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Package::enablePrepareData();
    }

    public function testPrepareData(): void
    {
        $p = new Package(
            weight: 12.3,
            dimension: new Dimension(12, 12, 12),
            additionalInfo: 'FOO BAR<>',
            costCenter: 'Alpha-Number'
        );
        self::assertEquals('FOO BAR', $p->getAdditionalInfo());
        self::assertEquals('AlphaNumber', $p->getCostCenter());
    }
}
