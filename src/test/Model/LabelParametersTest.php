<?php

namespace Gam\Estafeta\Command\Test\Model;

use Gam\Estafeta\Command\Model\Account;
use Gam\Estafeta\Command\Model\Address;
use Gam\Estafeta\Command\Model\Contact;
use Gam\Estafeta\Command\Model\ContactPhone;
use Gam\Estafeta\Command\Model\ContentType;
use Gam\Estafeta\Command\Model\Country;
use Gam\Estafeta\Command\Model\Dimension;
use Gam\Estafeta\Command\Model\Enum\LocationType;
use Gam\Estafeta\Command\Model\Enum\PackagingType;
use Gam\Estafeta\Command\Model\Enum\PaperType;
use Gam\Estafeta\Command\Model\Enum\PrintType;
use Gam\Estafeta\Command\Model\LabelParameters;
use Gam\Estafeta\Command\Model\Location;
use Gam\Estafeta\Command\Model\LocationCategory;
use Gam\Estafeta\Command\Model\LocationSection;
use Gam\Estafeta\Command\Model\Package;
use Gam\Estafeta\Command\Model\PrintConfig;
use Gam\Estafeta\Command\Model\Rfc;
use Gam\Estafeta\Command\Model\Service;

class LabelParametersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function tokenized(): void
    {
        $label = new LabelParameters(
            new Account('5895301-GRUPO SODB SA DE CV', '5895301'),
            $this->newOrigin(),
            $this->newDestination(),
            new Package(2.0, new Dimension(100, 50, 50)),
            new Service(Service::NEXT_DAY, '62|1|NOR'),
            new ContentType('111619', 'CAJA'),
            PackagingType::ENVELOPE(),
            new PrintConfig(
                PrintType::LOCAL(),
                PaperType::BOND(),
            )
        );
        $expected = file_get_contents(__DIR__ . '/../_files/labelParameters.txt');
        self::assertEquals(
            $expected,
            \Gam\Estafeta\Command\Helpers\Objects::tokenize($label)
        );
    }

    private function newOrigin(): Location
    {
        $originContact = new Contact(
            'redacted',
            'REdACTED',
            new Rfc('REDÁCTED'),
            null,
            new ContactPhone(null, '6623291184'),
        );
        $originSection = new LocationSection(
            '83177',
            Country::MEXICO(),
            'Sonora (SON)',
            'HERMOSILLO',
            'BENEI RESIDENCIAL'
        );
        $originAddress = new Address('BAMI', '1');
        return new Location(
            '29300948',
            $originSection,
            $originAddress,
            new LocationCategory('318650'),
            LocationType::ORIGIN(),
            $originContact,
            'HMO'
        );
    }

    private function newDestination(): Location
    {
        $contact = new Contact(
            'REDACTED',
            'REDACTED',
            new Rfc('REDACTED'),
            null,
            new ContactPhone(null, '6672179828'),
        );
        $section = new LocationSection(
            '80308',
            Country::MEXICO(),
            'Sinaloa (SIN)',
            'CULIACAN',
            'MIGUEL HIDALGO'
        );
        $address = new Address('ÓSCAR LIERA', '12701');
        return new Location(
            '',
            $section,
            $address,
            LocationCategory::OTHERS(),
            LocationType::DESTINATION(),
            $contact
        );
    }
}
