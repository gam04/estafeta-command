<?php

namespace Gam\Estafeta\Command\Test\Model\Package;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Dimension;
use Gam\Estafeta\Command\Model\Package;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Package::disablePrepareData();
    }

    public function testThrowsErrorOnInvalidWeight(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The item 'weight' expects to be in range 1..69.9, 0.0 given");
        new Package(
            weight: 0.0,
            dimension: new Dimension(12, 12, 12),
            additionalInfo: 'FOO BAR',
            costCenter:  'BAR FOO',
            declaredValue: 12.3
        );
    }

    public function testThrowsErrorOnInvalidInfo(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'additionalInfo'");
        $p = new Package(
            weight: 12.3,
            dimension: new Dimension(12, 12, 12),
            additionalInfo: 'FOO BAR<>'
        );
    }

    public function testThrowsErrorOnInvalidCenterCost(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The length of item 'costCenter'");
        new Package(
            weight: 12.3,
            dimension: new Dimension(12, 12, 12),
            additionalInfo: 'FOO BAR',
            costCenter: ''
        );
    }

    public function testThrowsErrorOnInvalidDeclaredValue(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The item 'declaredValue' expects");
        new Package(
            weight: 12.3,
            dimension: new Dimension(12, 12, 12),
            additionalInfo: 'FOO BAR',
            costCenter: 'COST CENTER',
            declaredValue: 0.1
        );
    }
}
