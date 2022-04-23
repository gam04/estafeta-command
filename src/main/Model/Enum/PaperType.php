<?php

namespace Gam\Estafeta\Command\Model\Enum;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static self BOND()
 * @method static self THERMAL_PRINTER()
 */
final class PaperType extends Enum
{
    private const BOND = 'B';

    private const THERMAL_PRINTER = 'T';
}
