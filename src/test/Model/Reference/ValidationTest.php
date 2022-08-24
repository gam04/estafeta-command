<?php

namespace Gam\Estafeta\Command\Test\Model\Reference;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Reference;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Reference::disablePrepareData();
    }

    public function testThrowErrorOnInvalidBetweenValue(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("'Cadena no alfanumerica' for item 'betweenStreet'");
        new Reference(betweenStreet: 'Agua Azul#20', andStreet: 'Agua Verde');
    }

    public function testThrowErrorOnInvalidAndStreedValue(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("'Cadena no alfanumerica' for item 'andStreet'");
        new Reference(betweenStreet: 'Agua Azul', andStreet: 'Agua Verde. 20');
    }

    public function testThrowErrorOnInvalidShedValue(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("'Cadena no alfanumerica' for item 'shed'");
        new Reference(betweenStreet: 'Agua Azul', andStreet: 'Agua Verde 20', shed: 'sh.1');
    }

    public function testThrowErrorOnInvalidPlatformValue(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("'Cadena no alfanumerica' for item 'platform'");
        new Reference(betweenStreet: 'Agua Azul', andStreet: 'Agua Verde', shed: 'shed1', platform: 'pl.1');
    }
}
