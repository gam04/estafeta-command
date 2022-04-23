<?php

namespace Gam\Estafeta\Command\Model;

class Country
{
    private string $id;

    private string $name;

    public static function MEXICO(): self
    {
        return new self('MX', 'MEXICO');
    }

    /**
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
