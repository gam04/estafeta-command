<?php

namespace Gam\Estafeta\Command\Test\Model\ContactPhone;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\ContactPhone;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        ContactPhone::disablePrepareData();
    }

    public function testThrowErrorOnInvalidPhoneNumber(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("No es un número telefonico válido' for item 'phoneNumber'");
        new ContactPhone(phoneNumber: '(229)2255881');
    }

    public function testThrowErrorOnInvalidMobileNumber(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("No es un número telefonico válido' for item 'mobileNumber'");
        new ContactPhone(mobileNumber: '(229)2255881');
    }
}
