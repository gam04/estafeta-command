<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class LabelReference extends ValidatedModel
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
        parent::__construct(compact(['contentDescription', 'reference', 'description']));
        $this->contentDescription = $this->normalized->contentDescription;
        $this->reference = $this->normalized->reference;
        $this->description = $this->normalized->description;
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

    protected function validationRules(): array
    {
        return [
            'contentDescription' => Expect::string()->min(1)->max(100)
                ->assert(...Rules::alphanumeric()),
            'reference' => Expect::string()->min(2)->max(25)
                ->assert(...Rules::validDescription()),
            'description' => Expect::string()->min(1)->max(100)
                ->assert(...Rules::alphanumeric()),
        ];
    }

    protected function prepareData(): array
    {
        return [
            'contentDescription' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
            'reference' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofValidDescription'],
            'description' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
        ];
    }
}
