<?php

namespace Gam\Estafeta\Command\Helpers;

final class Arrays
{
    /**
     * @param array<string, mixed> $main
     * @param string|array<int,string> $keys
     * @return array<string, mixed>
     */
    public static function only(array $main, $keys): array
    {
        if (is_string($keys)) {
            $keys = [$keys];
        }
        return array_intersect_key($main, array_flip($keys));
    }
}
