<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class ContactPhone extends ValidatedModel
{
    /**
     * @var string|null The contact's phone number
     */
    private ?string $phoneNumber;

    /**
     * @var string|null The contact's mobile number.
     */
    private ?string $mobileNumber;

    /**
     * @param string|null $phoneNumber
     * @param string|null $mobileNumber
     */
    public function __construct(?string $phoneNumber = null, ?string $mobileNumber = null)
    {
        parent::__construct(compact(['phoneNumber', 'mobileNumber']));
        $this->phoneNumber = $this->normalized->phoneNumber;
        $this->mobileNumber = $this->normalized->mobileNumber;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    /**
     * @return array<string, mixed>
     */
    protected function validationRules(): array
    {
        return [
            'phoneNumber' => Expect::string()->nullable()->assert(...Rules::phoneNumber()),
            'mobileNumber' => Expect::string()->nullable()->assert(...Rules::phoneNumber()),
        ];
    }
}
