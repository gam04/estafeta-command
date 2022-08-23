<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class Address extends ValidatedModel
{
    private string $firstStreet;

    private ?string $secondStreet;

    private string $streetAddress;

    private ?string $apartmentNumber;

    /**
     * @var Reference|null
     */
    private ?Reference $reference;

    /**
     * @param string $firstStreet
     * @param string $streetAddress
     * @param string|null $apartmentNumber
     * @param string|null $secondStreet
     * @param Reference|null $reference
     */
    public function __construct(
        string $firstStreet,
        string $streetAddress,
        string $apartmentNumber = null,
        string $secondStreet = null,
        Reference $reference = null
    ) {
        parent::__construct(compact(['firstStreet', 'streetAddress', 'apartmentNumber', 'secondStreet']));
        $this->firstStreet = $this->normalized->firstStreet;
        $this->secondStreet = $this->normalized->secondStreet;
        $this->streetAddress = $this->normalized->streetAddress;
        $this->apartmentNumber = $this->normalized->apartmentNumber;
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
     * @return string|null
     */
    public function getSecondStreet(): ?string
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
     * @return ?string
     */
    public function getApartmentNumber(): ?string
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

    /**
     * @return array<string, mixed>
     */
    protected function validationRules(): array
    {
        return [
            'firstStreet' => Expect::string()->required()
                ->min(2)->max(30)
                ->assert(...Rules::validDescription()),

            'streetAddress' => Expect::string()->required()
                ->min(1)->max(5)
                ->assert(...Rules::alphanumeric()),

            'secondStreet' => Expect::string()->nullable()
                ->min(2)->max(30)
                ->assert(...Rules::validDescription()),

            'apartmentNumber' => Expect::string()->nullable()
                ->min(1)->max(5)
                ->assert(...Rules::alphanumeric()),
        ];
    }

    protected function prepareData(): array
    {
        return [
            'firstStreet' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofValidDescription'],
            'streetAddress' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
            'apartmentNumber' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofValidDescription'],
            'secondStreet' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
        ];
    }
}
