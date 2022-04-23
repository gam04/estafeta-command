<?php

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Model\Enum\PaperType;
use Gam\Estafeta\Command\Model\Enum\PrintType;

class PrintConfig
{
    private PrintType $printType;

    private PaperType $paperType;

    /**
     * @param PrintType $printType
     * @param PaperType $paperType
     */
    public function __construct(PrintType $printType, PaperType $paperType)
    {
        $this->printType = $printType;
        $this->paperType = $paperType;
    }

    /**
     * @return PrintType
     */
    public function getPrintType(): PrintType
    {
        return $this->printType;
    }

    /**
     * @return PaperType
     */
    public function getPaperType(): PaperType
    {
        return $this->paperType;
    }
}
