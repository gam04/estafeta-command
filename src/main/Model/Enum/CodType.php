<?php

namespace Gam\Estafeta\Command\Model\Enum;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static self PDV_OFFICE()
 * @method static self HOME_ADDRESS()
 * @method static self DISTRIBUTOR()
 */
final class CodType extends Enum
{
    private const PDV_OFFICE = 'P';

    private const HOME_ADDRESS = 'R';

    private const DISTRIBUTOR = 'C';
}
