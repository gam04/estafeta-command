<?php

namespace Gam\Estafeta\Command;

interface Tokenized
{
    /**
     * @return string The delimiter character
     */
    public function delimiter(): string;

    /**
     * @return array<int,mixed> The data to be tokenized with the specified character
     */
    public function data(): array;
}
