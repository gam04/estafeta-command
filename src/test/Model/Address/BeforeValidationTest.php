<?php

namespace Gam\Estafeta\Command\Test\Model\Address;

use Gam\Estafeta\Command\Model\Address;

class BeforeValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Address::enablePrepareData();
    }

    public function testPrepareData(): void
    {
        $address = new Address("Agua Azul' 131", '#23', '<NA>', '"Agua Verde');
        self::assertEquals('Agua Azul 131', $address->getFirstStreet());
        self::assertEquals('23', $address->getStreetAddress());
        self::assertEquals('NA', $address->getApartmentNumber());
        self::assertEquals('Agua Verde', $address->getSecondStreet());
    }
}
