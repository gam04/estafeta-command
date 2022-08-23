<?php

namespace Gam\Estafeta\Command\Validation;

final class Cleaner
{
    public static function ofValidDescription(?string $content): ?string
    {
        if (is_null($content)) {
            return null;
        }

        return preg_replace("/[^a-z ÁÉÍÓÚáéíóú\d.,;:#*^\/]/iu", '', $content);
    }

    public static function ofAlphanumeric(?string $content): ?string
    {
        if (is_null($content)) {
            return null;
        }

        return preg_replace("/[^a-zÁÉÍÓÚáéíóú \d_]/iu", '', $content);
    }

    /**
     * @param callable[][]|callable[] $replace
     * @param array<string, mixed> $subject
     * @return array<string, mixed>
     */
    public static function arrayCallback(array $replace, array $subject): array
    {
        $_subject = $subject;
        foreach ($replace as $key => $callbacks) {
            if (isset($_subject[$key])) {
                if (! is_callable($callbacks) && is_array($callbacks)) {
                    foreach ($callbacks as $callback) {
                        $_subject[$key] = $callback($_subject[$key]);
                    }
                } else {
                    $_subject[$key] = $callbacks($_subject[$key]);
                }
            }
        }
        return $_subject;
    }
}
