<?php

declare(strict_types=1);

namespace Gam\Estafeta\Command\Model\Enum;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static self ORIGIN()
 * @method static self DESTINATION()
 */
final class LocationType extends Enum
{
    private const ORIGIN = 'ORIGEN';

    private const DESTINATION = 'DESTINO';
}
