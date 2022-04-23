<?php

namespace Gam\Estafeta\Command\Model;

class LabelReference
{
    private string $contentDescription;

    private string $reference;

    private string $description;

    /**
     * @param string $contentDescription
     * @param string $reference
     * @param string $description
     */
    public function __construct(string $contentDescription, string $reference, string $description)
    {
        $this->contentDescription = $contentDescription;
        $this->reference = $reference;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getContentDescription(): string
    {
        return $this->contentDescription;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
