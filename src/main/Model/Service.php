<?php

namespace Gam\Estafeta\Command\Model;

class Service
{
    public const NEXT_DAY = 'Día Siguiente Prepagado sin crédito';

    public const LAND_PAID = 'Terrestre Prepagado sin crédito';

    public const CREDIT_NEXT_DAY = 'Dia siguiente Prepagado';

    public const CREDIT_LAND_PAID = 'Terrestre Prepagado';

    private string $name;

    private string $id;

    /**
     * @param string $name
     * @param string $id
     */
    public function __construct(string $name, string $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
