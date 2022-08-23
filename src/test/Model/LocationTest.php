<?php

namespace Gam\Estafeta\Command\Test\Model;

use Gam\Estafeta\Command\Helpers\Objects;
use Gam\Estafeta\Command\Model\Address;
use Gam\Estafeta\Command\Model\Contact;
use Gam\Estafeta\Command\Model\ContactPhone;
use Gam\Estafeta\Command\Model\Country;
use Gam\Estafeta\Command\Model\Enum\LocationType;
use Gam\Estafeta\Command\Model\Location;
use Gam\Estafeta\Command\Model\LocationCategory;
use Gam\Estafeta\Command\Model\LocationSection;
use Gam\Estafeta\Command\Model\Rfc;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    private Location $origin;

    protected function setUp(): void
    {
        parent::setUp();

        $originContact = new Contact(
            'REDACTED',
            'REDACTED',
            new Rfc('LEGAL REDACTED'),
            null,
            new ContactPhone(mobileNumber: '6623291184'),
        );
        $originSection = new LocationSection(
            '83177',
            Country::MEXICO(),
            'Sonora (SON)',
            'HERMOSILLO',
            'BENEI RESIDENCIAL'
        );
        $originAddress = new Address('BAMI', '1');
        $this->origin = new Location(
            '29300948',
            $originSection,
            $originAddress,
            new LocationCategory('318650'),
            LocationType::ORIGIN(),
            $originContact,
            'HMO'
        );
    }

    /**
     * @test
     */
    public function tokenized(): void
    {
        $expected = <<<EOL
        BAMI|29300948||318650||HMO|BENEI RESIDENCIAL|REDACTED|||
        Sonora (SON)|HERMOSILLO|REDACTED|1||MX|MEXICO|LEGAL REDACTED||
        6623291184|83177|||ORIGEN|
        EOL;

        $expected = str_replace(["\n", "\t", "\r"], '', $expected);
        self::assertEquals(
            $expected,
            Objects::tokenize($this->origin)
        );
    }

    /**
     * @test
     */
    public function stringRepresentation(): void
    {
        $expected = <<<EOL
        Domicilio: BAMI 1  , Col. BENEI RESIDENCIAL C.P. 83177. HERMOSILLO Sonora (SON).
         Tel.  Razón Social: LEGAL REDACTED Contacto: REDACTED
        EOL;

        $expected = str_replace(["\n", "\t", "\r"], '', $expected);
        self::assertEquals($expected, (string)$this->origin);
    }
}
