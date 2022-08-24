<?php

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class Rfc extends ValidatedModel
{
    private ?string $rfc;

    /**
     * @var string Razon o denominacion social.
     */
    private string $legalName;

    /**
     * @param string $legalName
     * @param string|null $rfc
     */
    public function __construct(string $legalName, ?string $rfc = null)
    {
        parent::__construct(compact(['legalName', 'rfc']));
        $this->legalName = $this->normalized->legalName;
        $this->rfc = $this->normalized->rfc;
    }

    /**
     * @return string|null
     */
    public function getRfc(): ?string
    {
        return $this->rfc;
    }

    /**
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    protected function validationRules(): array
    {
        return [
            'legalName' => Expect::string()->required()
                ->min(2)->max(50)
                ->assert(...Rules::validDescription()),

            'rfc' => Expect::string()->nullable()
                ->assert(...Rules::rfc()),
        ];
    }
}
