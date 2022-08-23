<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class Dimension extends ValidatedModel
{
    private int $length;

    private int $high;

    private int $width;

    /**
     * @param int $length
     * @param int $high
     * @param int $width
     */
    public function __construct(int $length, int $high, int $width)
    {
        parent::__construct(compact(['length', 'high', 'width']));
        $this->length = $this->normalized->length;
        $this->high = $this->normalized->high;
        $this->width = $this->normalized->width;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getHigh(): int
    {
        return $this->high;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    protected function validationRules(): array
    {
        return [
            'length' => Expect::int()->required()->min(1)->max(150),
            'high' => Expect::int()->required()->min(1)->max(155),
            'width' => Expect::int()->required()->min(1)->max(115),
        ];
    }
}
