<?php

namespace Gam\Estafeta\Command\Validation;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Nette\Schema\Expect;

trait ValidatesData
{
    /**
     * Indicate if the given data has to be prepared before
     * validation
     *
     * @return bool
     */
    protected bool $_prepareDataBefore = false;

    /**
     * @var \stdClass
     */
    protected \stdClass $normalized;

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    protected function validate(array $data): void
    {
        $processor = new \Nette\Schema\Processor();
        try {
            $this->normalized = $normalized = $processor->process($this->schema(), $data);
        } catch (\Nette\Schema\ValidationException $e) {
            throw new InvalidDataException("The given data is invalid. {$e->getMessages()[0]}");
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function validationRules(): array
    {
        return [];
    }

    private function schema(): \Nette\Schema\Elements\Structure
    {
        $schema = Expect::structure($this->validationRules());
        if ($this->_prepareDataBefore) {
            $schema->before(\Closure::fromCallable([$this, 'beforeValidation']));
        }
        return $schema;
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    protected function beforeValidation(array $data = null): array
    {
        return [];
    }
}
