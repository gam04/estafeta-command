<?php

namespace Gam\Estafeta\Command\Model;

class Rfc
{
    private string $rfc;

    /**
     * @var string Razon o denominacion social.
     */
    private string $legalName;

    /**
     * @param string $legalName
     * @param string $rfc
     */
    public function __construct(string $legalName, string $rfc = '')
    {
        $this->legalName = $legalName;
        $this->rfc = $rfc;
    }

    /**
     * @return string
     */
    public function getRfc(): string
    {
        return $this->rfc;
    }

    /**
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }
}
