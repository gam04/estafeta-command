<?php

namespace Gam\Estafeta\Command\Model;

class Dimension
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
        $this->length = $length;
        $this->high = $high;
        $this->width = $width;
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
}
