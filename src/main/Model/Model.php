<?php

namespace Gam\Estafeta\Command\Model;

/**
 * @internal
 */
abstract class Model
{
    /**
     * The allowed attributes to be assigned through constructor
     * @var array<string>
     */
    protected array $allowedProperties = [];

    /**
     * @var array<string, mixed>
     */
    private array $properties;

    /**
     * @param array<string, mixed> $properties
     */
    public function __construct(array $properties = [])
    {
        $this->properties = $properties;
        $this->fillProperties($properties);
    }

    /**
     * @param array<string, mixed> $properties
     * @return void
     */
    private function fillProperties(array $properties): void
    {
        foreach ($properties as $property => $value) {
            if (in_array($property, $this->allowedProperties, true)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->$name;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        if (! in_array($name, $this->allowedProperties, true)) {
            throw new \InvalidArgumentException("Property {$name} not allowed to be set");
        }

        $this->$name = $value;
    }

    public function __isset(string $name): bool
    {
        return property_exists($this, $name);
    }
}
