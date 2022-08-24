<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class Package extends ValidatedModel
{
    private float $weight;

    /**
     * @var Dimension|null
     */
    private ?Dimension $dimension;

    private ?string $additionalInfo;

    private ?string $costCenter;

    private ?float $declaredValue;

    /**
     * @param float $weight
     * @param Dimension|null $dimension
     * @param string|null $additionalInfo
     * @param string|null $costCenter
     * @param float|null $declaredValue
     */
    public function __construct(
        float $weight,
        ?Dimension $dimension = null,
        ?string $additionalInfo = null,
        ?string $costCenter = null,
        ?float $declaredValue = null,
    ) {
        parent::__construct(compact(['weight', 'additionalInfo', 'costCenter', 'declaredValue']));
        $this->weight = $this->normalized->weight;
        $this->dimension = $dimension;
        $this->additionalInfo = $this->normalized->additionalInfo;
        $this->costCenter = $this->normalized->costCenter;
        $this->declaredValue = $this->normalized->declaredValue;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return Dimension|null
     */
    public function getDimension(): ?Dimension
    {
        return $this->dimension;
    }

    /**
     * @return string|null
     */
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * @return string|null
     */
    public function getCostCenter(): ?string
    {
        return $this->costCenter;
    }

    /**
     * @return float|null
     */
    public function getDeclaredValue(): ?float
    {
        return $this->declaredValue;
    }

    protected function validationRules(): array
    {
        return [
            'weight' => Expect::float()->required()->min(1.0)->max(69.9),
            'additionalInfo' => Expect::string()->nullable()
                ->min(2)->max(25)
                ->assert(...Rules::validDescription()),
            'costCenter' => Expect::string()->nullable()
                ->min(1)->max(40)
                ->assert(...Rules::alphanumeric()),
            'declaredValue' => Expect::float()->nullable()
                ->min(1.0)->max(9999999.9),
        ];
    }

    protected function prepareData(): array
    {
        return [
            'additionalInfo' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofValidDescription'],
            'costCenter' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
        ];
    }
}
