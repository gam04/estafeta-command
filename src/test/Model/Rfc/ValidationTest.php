<?php

namespace Gam\Estafeta\Command\Test\Model\Rfc;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Rfc;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Rfc::disablePrepareData();
    }

    public function testThrowsErrorOnInvalidLegalName(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The length of item 'legalName' expects to be in range 2..50");
        new Rfc(legalName: 'L');
    }

    public function testThrowsErrorOnInvalidRfc(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("Failed assertion 'RFC invalido' for item 'rfc'");
        new Rfc(legalName: 'FOO SA DE CV', rfc: 'BBB010101BBB');
    }
}
