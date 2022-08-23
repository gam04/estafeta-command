<?php

namespace Gam\Estafeta\Command\Test\Model\Contact;

use Gam\Estafeta\Command\Model\Contact;
use Gam\Estafeta\Command\Model\ContactPhone;
use Gam\Estafeta\Command\Model\Rfc;

class MainTest extends \PHPUnit\Framework\TestCase
{
    public function testToString(): void
    {
        $c = new Contact(
            shortName: 'Foo Bar',
            contactName: 'John Milton',
            rfc: new Rfc('Legal SA'),
            email:'foo@bar.com',
            phone: new ContactPhone(phoneNumber: '2294561204')
        );

        self::assertEquals('Tel. 2294561204 Razón Social: LEGAL SA Contacto: JOHN MILTON', (string) $c);
    }
}
