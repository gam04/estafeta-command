<?php

namespace Gam\Estafeta\Command\Validation;

final class Rules
{
    /**
     * @return array<int,mixed>
     */
    public static function phoneNumber(): array
    {
        return [[self::class, 'isPhoneNumber'], 'No es un número telefonico válido'];
    }

    /**
     * @return array<int, mixed>
     */
    public static function validDescription(): array
    {
        return [[self::class, 'isValidDescription'], 'Este campo solo acepta [, . - _ ; : & ( ) # * ^ /]'];
    }

    /**
     * @return array<int,mixed>
     */
    public static function alphanumeric(): array
    {
        return [[self::class, 'isAlphanumeric'], 'Cadena no alfanumerica'];
    }

    /**
     * @return array<int,mixed>
     */
    public static function rfc(): array
    {
        return [[self::class, 'isRfc'], 'RFC invalido'];
    }

    public static function isValidDescription(?string $content): bool
    {
        if (is_null($content)) {
            return true;
        }
        return 1 === preg_match("/^[a-z ÁÉÍÓÚáéíóú\d.,;:#*^\/]+$/iu", $content);
    }

    public static function isAlphanumeric(?string $content): bool
    {
        if (is_null($content)) {
            return true;
        }
        return 1 === preg_match("/^[a-zÁÉÍÓÚáéíóú \d_]+$/iu", $content);
    }

    public static function isRfc(?string $content): bool
    {
        if (is_null($content)) {
            return true;
        }

        return 1 === preg_match(
            "/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/",
            $content
        );
    }

    public static function isPhoneNumber(?string $content): bool
    {
        if (is_null($content)) {
            return true;
        }
        return 1 === preg_match("/^\d{3}[-\s]?\d{3}[-\s]?\d{4,6}$/", $content);
    }
}
