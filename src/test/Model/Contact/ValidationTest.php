<?php

namespace Gam\Estafeta\Command\Test\Model\Contact;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Contact;
use Gam\Estafeta\Command\Model\ContactPhone;
use Gam\Estafeta\Command\Model\Rfc;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Contact::disablePrepareData();
    }

    public function testThrowErrorOnInvalidshortName(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'shortName'");
        new Contact(
            shortName: 'Foo Bar{}',
            contactName: 'John Milton',
            rfc: new Rfc('Legal SA'),
            email:'foo@bar.com',
            phone: new ContactPhone(phoneNumber: '2294561204')
        );
    }

    public function testThrowErrorOnInvalidContactName(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'contactName'");
        new Contact(
            shortName: 'Foo Bar',
            contactName: 'John Miltôn',
            rfc: new Rfc('Legal SA'),
            email:'foo@bar.com',
            phone: new ContactPhone(phoneNumber: '2294561204')
        );
    }

    public function testThrowErrorOnInvalidEmail(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("The item 'email' expects to be null or email");
        new Contact(
            shortName: 'Foo Bar',
            contactName: 'John Milton',
            rfc: new Rfc('Legal SA'),
            email:'foo@',
            phone: new ContactPhone(phoneNumber: '2294561204')
        );
    }
}
