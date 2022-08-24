<?php

namespace Gam\Estafeta\Command\Test\Model\LabelReference;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\LabelReference;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        LabelReference::disablePrepareData();
    }

    public function testThrowExceptionOnInvalidContent(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("'Cadena no alfanumerica' for item 'contentDescription'");
        new LabelReference(contentDescription: 'BAD-DESCRIPTION', reference: 'Reference', description: 'Description');
    }

    public function testThrowExceptionOnInvalidReference(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("for item 'reference'");
        new LabelReference(contentDescription: 'Description', reference: 'Reference{}', description: 'Description');
    }

    public function testThrowExceptionOnInvalidDescription(): void
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage("'Cadena no alfanumerica' for item 'description'");
        new LabelReference(contentDescription: 'Description', reference: 'Reference', description: 'A-Description');
    }
}
