<?php

namespace Gam\Estafeta\Command\Test\Model\Address;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Address;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Address::disablePrepareData();
    }

    public function testThrowErrorOnInvalidFirstStreet(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'firstStreet'");
        new Address(firstStreet: "'Agua Azul'", streetAddress: '23^');
    }

    public function testThrowErrorOnInvalidStreetAddress(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'streetAddress'");
        new Address(firstStreet: 'Agua Azul', streetAddress: '23^');
    }

    public function testThrowErrorOnInvalidApartmentNumber(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'apartmentNumber'");
        new Address(firstStreet: 'Agua Azul', streetAddress: '23', apartmentNumber: 'N/A');
    }

    public function testThrowErrorOnInvalid(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'secondStreet'");
        new Address(firstStreet: 'Agua Azul', streetAddress: '23', apartmentNumber: 'NA', secondStreet: 'Romeo{23}');
    }
}
