<?php

namespace Gam\Estafeta\Command\Model\Enum;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static self PACKAGE()
 * @method static self ENVELOPE()
 */
final class PackagingType extends Enum
{
    private const PACKAGE = 'Paquete';

    private const ENVELOPE = 'Sobre';

    public function id(): string
    {
        if (self::PACKAGE === $this->value) {
            return 'P';
        }
        if (self::ENVELOPE === $this->value) {
            return 'S';
        }

        throw new \UnexpectedValueException('invalid packaging type value');
    }
}
