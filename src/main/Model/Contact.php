<?php

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Helpers\NormalizeInput;

class Contact
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

    private string $email;

    private Rfc $rfc;

    /**
     * @param string $shortName
     * @param string $contactName
     * @param Rfc $rfc
     * @param string $email
     * @param ContactPhone|null $phone
     */
    public function __construct(
        string $shortName,
        string $contactName,
        Rfc $rfc,
        string $email = '',
        ContactPhone $phone = null
    ) {
        $this->phone = $phone;
        $this->shortName = $shortName;
        $this->contactName = $contactName;
        $this->email = $email;
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
     * @return string
     */
    public function getEmail(): string
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
}
