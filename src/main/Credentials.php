<?php

namespace Gam\Estafeta\Command;

class Credentials
{
    /**
     * @var string The User name.
     */
    private string $user;

    /**
     * @var string The password.
     */
    private string $password;

    /**
     * @param string $user
     * @param string $password
     */
    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
