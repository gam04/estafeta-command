<?php

namespace Gam\Estafeta\Command\Test\Validation;

use Gam\Estafeta\Command\Validation\Rules;
use PHPUnit\Framework\TestCase;

class RulesTest extends TestCase
{
    public function testIsValidDescription(): void
    {
        self::assertTrue(Rules::isValidDescription('Foo Bar'));
        self::assertTrue(Rules::isValidDescription('REDÁCTED'));
        self::assertTrue(Rules::isValidDescription('Foo Bar Lorem., John; Bar:#30*10^1'));
        self::assertFalse(Rules::isValidDescription("Invalid' \" "));
        self::assertFalse(Rules::isValidDescription('Foo Bar <>{}_-'));
    }

    public function testIsAlphanumeric(): void
    {
        self::assertTrue(Rules::isAlphanumeric('Foo Bar123'));
        self::assertFalse(Rules::isAlphanumeric('Foo-Bar-123'));
    }

    public function testIsRfc(): void
    {
        self::assertTrue(Rules::isRfc('AAA010101AAA'));
        self::assertTrue(Rules::isRfc('G&L020822MF6'));
        self::assertTrue(Rules::isRfc('G&L020822MF6'));
        self::assertFalse(Rules::isRfc('BBB010101BBB'));
    }

    public function testIsPhoneNumber(): void
    {
        self::assertTrue(Rules::isPhoneNumber('2294571783'));
        self::assertTrue(Rules::isPhoneNumber('229-457-1783'));
        self::assertTrue(Rules::isPhoneNumber('229 457 1783'));
        self::assertFalse(Rules::isPhoneNumber('(229)-457-1783)'));
    }
}
