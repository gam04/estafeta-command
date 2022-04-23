<?php

namespace Gam\Estafeta\Command\Model;

class Address
{
    private string $firstStreet;

    private string $secondStreet;

    private string $streetAddress;

    private string $apartmentNumber;

    /**
     * @var Reference|null
     */
    private ?Reference $reference;

    /**
     * @param string $firstStreet
     * @param string $streetAddress
     * @param string $apartmentNumber
     * @param string $secondStreet
     * @param Reference|null $reference
     */
    public function __construct(
        string $firstStreet,
        string $streetAddress,
        string $apartmentNumber = '',
        string $secondStreet = '',
        Reference $reference = null
    ) {
        $this->firstStreet = $firstStreet;
        $this->secondStreet = $secondStreet;
        $this->streetAddress = $streetAddress;
        $this->apartmentNumber = $apartmentNumber;
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getFirstStreet(): string
    {
        return $this->firstStreet;
    }

    /**
     * @return string
     */
    public function getSecondStreet(): string
    {
        return $this->secondStreet;
    }

    /**
     * @return string
     */
    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    /**
     * @return string
     */
    public function getApartmentNumber(): string
    {
        return $this->apartmentNumber;
    }

    /**
     * @return Reference|null
     */
    public function getReference(): ?Reference
    {
        return $this->reference;
    }
}
