<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Helpers\NormalizeInput;
use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class Contact extends ValidatedModel
{
    use NormalizeInput;

    /**
     * @var ContactPhone|null
     */
    private ?ContactPhone $phone;

    /**
     * @var string A short name.
     */
    private string $shortName;

    private string $contactName;

    private ?string $email;

    private Rfc $rfc;

    /**
     * @param string $shortName
     * @param string $contactName
     * @param Rfc $rfc
     * @param string|null $email
     * @param ContactPhone|null $phone
     */
    public function __construct(
        string $shortName,
        string $contactName,
        Rfc $rfc,
        ?string $email = null,
        ?ContactPhone $phone = null
    ) {
        parent::__construct(compact(['shortName', 'contactName', 'email']));
        $this->phone = $phone;
        $this->shortName = $this->normalized->shortName;
        $this->contactName = $this->normalized->contactName;
        $this->email = $this->normalized->email;
        $this->rfc = $rfc;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Tel. %s Razón Social: %s Contacto: %s%s',
            $this->phone? $this->phone->getPhoneNumber() : '',
            $this->normalize($this->rfc->getLegalName()),
            $this->normalize($this->contactName ?? ''),
            $this->rfc->getRfc()
        );
    }

    /**
     * @return ContactPhone|null
     */
    public function getPhone(): ?ContactPhone
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contactName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return Rfc
     */
    public function getRfc(): Rfc
    {
        return $this->rfc;
    }

    protected function validationRules(): array
    {
        return [
            'shortName' => Expect::string()->required()
                ->min(2)->max(50)
                ->assert(...Rules::validDescription()),

            'contactName' => Expect::string()->required()
                ->min(2)->max(30)
                ->assert(...Rules::validDescription()),

            'email' => Expect::email()->nullable(),
        ];
    }

    protected function prepareData(): array
    {
        return [
            'shortName' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofValidDescription'],
            'contactName' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofValidDescription'],
        ];
    }
}
