<?php

namespace Gam\Estafeta\Command\Helpers;

trait NormalizeInput
{
    private function normalize(?string $content): string
    {
        if (is_null($content)) {
            return '';
        }

        $unaccent = Strings::unaccent($content);
        return strtoupper($unaccent);
    }
}
