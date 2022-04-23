<?php

namespace Gam\Estafeta\Command\Helpers;

final class Strings
{
    public static function toUtf8(string $content, string $from): string
    {
        // If it's not already UTF-8, convert to it
        if (! self::isUtf8($content)) {
            return  mb_convert_encoding($content, 'utf-8', $from);
        }
        return $content;
    }

    public static function isUtf8(string $content): bool
    {
        return self::encodingIs($content, 'utf-8');
    }

    /**
     * @param string $content
     * @param string $encoding
     * @return bool
     */
    public static function encodingIs(string $content, string $encoding): bool
    {
        return false !== mb_detect_encoding($content, $encoding, true);
    }

    public static function toIso8859(string $content, string $from = 'utf-8'): string
    {
        if (! self::encodingIs($content, 'iso-8859-1')) {
            return  mb_convert_encoding($content, 'iso-8859-1', $from);
        }
        return $content;
    }

    public static function unaccent(string $content): string
    {
        return preg_replace(
            '~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i',
            '$1',
            htmlentities($content, ENT_QUOTES, 'UTF-8')
        );
    }
}
