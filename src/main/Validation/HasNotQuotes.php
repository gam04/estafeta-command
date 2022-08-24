<?php

namespace Gam\Estafeta\Command\Validation;

use Gam\Estafeta\Command\Helpers\Strings;

trait HasNotQuotes
{
    /**
     * @param array<string, mixed>|null $data
     * @return array<string, mixed>
     */
    protected function removeQuotes(array $data = null): array
    {
        return array_map(function ($value) {
            if (is_string($value)) {
                return Strings::replace($value, ['"', '\''], '');
            }
            return $value;
        }, $data);
    }
}
