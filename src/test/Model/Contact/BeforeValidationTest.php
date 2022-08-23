<?php

namespace Gam\Estafeta\Command\Test\Model\Contact;

use Gam\Estafeta\Command\Model\Contact;
use Gam\Estafeta\Command\Model\ContactPhone;
use Gam\Estafeta\Command\Model\Rfc;

class BeforeValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Contact::enablePrepareData();
    }

    public function testPrepareData(): void
    {
        $c = new Contact(
            shortName: '{Foo Bar}',
            contactName: "'John Milton'",
            rfc: new Rfc('Legal SA'),
            email:'foo@bar.com',
            phone: new ContactPhone(phoneNumber: '2294561204')
        );
        self::assertEquals('John Milton', $c->getContactName());
        self::assertEquals('Foo Bar', $c->getShortName());
    }
}
