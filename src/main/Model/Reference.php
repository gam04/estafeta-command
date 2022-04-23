<?php

namespace Gam\Estafeta\Command\Model;

class Reference
{
    private string $betweenStreet;

    private string $andStreet;

    private string $shed;

    private string $platform;

    private string $references;

    /**
     * @param string $betweenStreet
     * @param string $andStreet
     * @param string $shed
     * @param string $platform
     * @param string $references
     */
    public function __construct(
        string $betweenStreet,
        string $andStreet,
        string $shed,
        string $platform,
        string $references
    ) {
        $this->betweenStreet = $betweenStreet;
        $this->andStreet = $andStreet;
        $this->shed = $shed;
        $this->platform = $platform;
        $this->references = $references;
    }

    /**
     * @return string
     */
    public function getBetweenStreet(): string
    {
        return $this->betweenStreet;
    }

    /**
     * @return string
     */
    public function getAndStreet(): string
    {
        return $this->andStreet;
    }

    /**
     * @return string
     */
    public function getShed(): string
    {
        return $this->shed;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @return string
     */
    public function getReferences(): string
    {
        return $this->references;
    }
}
