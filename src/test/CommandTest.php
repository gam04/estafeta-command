<?php

namespace Gam\Estafeta\Command\Test;

use Gam\Estafeta\Command\Command;
use Gam\Estafeta\Command\Model\ContentType;
use Gam\Estafeta\Command\Model\Service;

class CommandTest extends TestCase
{
    private Command $command;

    /**
     * @throws \Gam\Estafeta\Command\Exception\AuthException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->command = new Command($this->validCredential());
    }

    /**
     * @test
     * @throws \Exception
     */
    public function fetchId(): void
    {
        self::assertEquals([
            'id' => $this->account->getId(),
            'name' => $this->account->getName(),
        ], $this->command->fetchId());
    }

    /**
     * @test
     * @throws \Exception
     */
    public function fetchServices(): void
    {
        self::assertEquals(
            new Service(Service::LAND_PAID, '72|1|NOR'),
            $this->command->fetchServices($this->account->getId())[4]
        );
    }

    /**
     * @test
     * @throws \Exception
     */
    public function fetchContentTypes(): void
    {
        self::assertEquals(
            new ContentType('111619', ContentType::BOX),
            $this->command->fetchContentTypes()[0]
        );
    }

    /**
     * @test
     * @throws \Exception
     */
    public function fetchSections(): void
    {
        $sections = $this->command->fetchSections('91778');
        self::assertCount(1, $sections);
        self::assertEquals('ADOLFO LOPEZ MATEOS', $sections->first()->getSuburb());
    }

    /**
     * @test
     * @throws \Exception
     */
    public function fetchLabelPdf(): void
    {
        $this->markTestSkipped('Run this test locally, with a valid LABEL ID');
        // change to an active label ID.

        /**@phpstan-ignore-next-line*/
        $filename = __DIR__ . '/_files/tmp/label.pdf';
        $pdf = $this->command->fetchLabelPdf('15042022072406251-141775');
        file_put_contents($filename, $pdf);
        self::assertFileExists($filename);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function fetchFrecuency(): void
    {
        $frecuency = $this->command->fetchFrecuency(
            '91778',
            new Service(Service::LAND_PAID, '72|1|NOR')
        );
        self::assertTrue($frecuency->onMonday());
        self::assertEmpty($frecuency->getReexp());
    }

    /**
     * @after
     */
    public function clear(): void
    {
        $this->command->logout();
    }
}
