<?php

namespace Gam\Estafeta\Command\Test;

use Gam\Estafeta\Command\Model\Country;
use Gam\Estafeta\Command\Model\LocationSection;
use Gam\Estafeta\Command\SectionList;

class SectionListTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var SectionList
     */
    private SectionList $sections;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sections = new SectionList(
            new LocationSection('91778', Country::MEXICO(), 'FOO', 'BAR', 'Redacted Crom'),
            new LocationSection('91779', Country::MEXICO(), 'JOHN', 'NEW', 'New Iron')
        );
    }

    /**
     * @test
     */
    public function listSize(): void
    {
        self::assertCount(2, $this->sections);
    }

    /**
     * @test
     */
    public function findBySuburb(): void
    {
        self::assertCount(1, $this->sections->findBySuburb('Redacted Crom'));
        self::assertCount(1, $this->sections->findBySuburb('RedactEd', true));
    }
}
