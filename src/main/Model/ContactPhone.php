<?php

namespace Gam\Estafeta\Command\Model;

class ContactPhone
{
    /**
     * @var string The contact's phone number
     */
    private string $phoneNumber;

    /**
     * @var string The contact's mobile number.
     */
    private string $mobileNumber;

    /**
     * @param string $phoneNumber
     * @param string $mobileNumber
     */
    public function __construct(string $phoneNumber = '', string $mobileNumber = '')
    {
        $this->phoneNumber = $phoneNumber;
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getMobileNumber(): string
    {
        return $this->mobileNumber;
    }
}
