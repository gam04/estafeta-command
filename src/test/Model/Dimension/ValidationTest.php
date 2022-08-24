<?php

namespace Gam\Estafeta\Command\Test\Model\Dimension;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Dimension;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Dimension::disablePrepareData();
    }

    public function testThrowErrorOnInvalidLength(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The item 'length' expects to be in range");
        new Dimension(200, 50, 50);
    }

    public function testThrowErrorOnInvalidHigh(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The item 'high' expects to be in range");
        new Dimension(100, 200, 50);
    }

    public function testThrowErrorOnInvalidWidth(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The item 'width' expects to be in range");
        new Dimension(100, 50, 200);
    }
}
