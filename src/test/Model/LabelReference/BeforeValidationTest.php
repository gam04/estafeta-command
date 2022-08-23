<?php

namespace Gam\Estafeta\Command\Test\Model\LabelReference;

use Gam\Estafeta\Command\Model\LabelReference;

class BeforeValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        LabelReference::enablePrepareData();
    }

    public function testPrepareData(): void
    {
        $l = new LabelReference(
            contentDescription: 'MY - DESCRIPTION',
            reference: 'Reference<>',
            description: 'Description - FOO'
        );
        self::assertEquals('MY  DESCRIPTION', $l->getContentDescription());
        self::assertEquals('Reference', $l->getReference());
        self::assertEquals('Description  FOO', $l->getDescription());
    }
}
