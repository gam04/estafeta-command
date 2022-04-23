<?php

namespace Gam\Estafeta\Command\Helpers;

trait NormalizeInput
{
    private function normalize(string $content): string
    {
        $unaccent = Strings::unaccent($content);
        return strtoupper($unaccent);
    }
}
