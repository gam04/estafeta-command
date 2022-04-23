<?php

namespace Gam\Estafeta\Command\Model;

class Package
{
    private float $weight;

    /**
     * @var Dimension|null
     */
    private ?Dimension $dimension;

    private string $additionalInfo;

    private string $costCenter;

    private string $declaredValue;

    /**
     * @param float $weight
     * @param ?Dimension $dimension
     * @param string $additionalInfo
     * @param string $costCenter
     * @param string $declaredValue
     */
    public function __construct(
        float $weight,
        Dimension $dimension = null,
        string $additionalInfo = '',
        string $costCenter = '',
        string $declaredValue = ''
    ) {
        $this->weight = $weight;
        $this->dimension = $dimension;
        $this->additionalInfo = $additionalInfo;
        $this->costCenter = $costCenter;
        $this->declaredValue = $declaredValue;
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
     * @return string
     */
    public function getAdditionalInfo(): string
    {
        return $this->additionalInfo;
    }

    /**
     * @return string
     */
    public function getCostCenter(): string
    {
        return $this->costCenter;
    }

    /**
     * @return string
     */
    public function getDeclaredValue(): string
    {
        return $this->declaredValue;
    }
}
