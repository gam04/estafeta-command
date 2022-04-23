<?php

namespace Gam\Estafeta\Command\Model;

class LocationCategory
{
    private string $id;

    private string $name;

    public static function OTHERS(): self
    {
        return new self('318650', 'Otros');
    }

    /**
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name = '')
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
