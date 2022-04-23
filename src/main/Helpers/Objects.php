<?php

namespace Gam\Estafeta\Command\Helpers;

use Gam\Estafeta\Command\Tokenized;
use ReflectionClass;

final class Objects
{
    /**
     * @param Tokenized $toTokenize
     * @return string
     */
    public static function tokenizeRecursive(Tokenized $toTokenize): string
    {
        $result = '';
        foreach ($toTokenize->data() as $i => $a) {
            if ($a instanceof Tokenized) {
                $result .= self::tokenizeRecursive($a);
            } else {
                $result .= $a;
                if ($i < count($toTokenize->data()) - 1) {
                    $result .= $toTokenize->delimiter();
                }
            }
        }
        return $result;
    }

    /**
     * Split object properties by specific delimiter
     * @param Tokenized $toTokenize
     * @param array<int,mixed> $extra
     * @return string
     */
    public static function tokenize(Tokenized $toTokenize, array $extra = []): string
    {
        return implode($toTokenize->delimiter(), array_merge($toTokenize->data(), $extra));
    }

    /**
     * @param object $object
     * @return array<string, mixed>
     */
    public static function toArray(object $object): array
    {
        $reflect = new ReflectionClass(get_class($object));
        $properties = $reflect->getProperties();
        $props = [];
        foreach ($properties as $property) {
            $props[$property->getName()] = $property->getValue();
        }
        return $props;
    }
}
