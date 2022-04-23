<?php

namespace Gam\Estafeta\Command\Test;

use Gam\Estafeta\Command\Tokenized;

/**
 * @property string $username
 * @property string $id
 * @property string $color
 */
class DummyModel extends \Gam\Estafeta\Command\Model\Model implements Tokenized
{
    protected array $allowedProperties = [
        'username', 'id', 'color',
    ];

    public function delimiter(): string
    {
        return '|';
    }

    public function data(): array
    {
        return [$this->username, $this->id, $this->color];
    }
}
