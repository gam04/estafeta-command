<?php

namespace Gam\Estafeta\Command\Model\Enum;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static self LOCAL()
 * @method static self SENDING_EMAIL()
 */
final class PrintType extends Enum
{
    private const LOCAL = 'L';

    private const SENDING_EMAIL = 'R';
}
