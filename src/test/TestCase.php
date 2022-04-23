<?php

namespace Gam\Estafeta\Command\Test;

use Gam\Estafeta\Command\Credentials;
use Gam\Estafeta\Command\Model\Account;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Credentials[]
     */
    protected array $credentials = [];

    protected Account $account;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadCredentials();
    }

    protected function validCredential(): Credentials
    {
        return $this->credentials[0];
    }

    protected function invalidCredential(): Credentials
    {
        return $this->credentials[1];
    }

    protected function invalidPasswordCredential(): Credentials
    {
        return $this->credentials[2];
    }

    private function loadCredentials(): void
    {
        if (! file_exists(__DIR__ . '/_files/.credentials.json')) {
            throw new \RuntimeException(
                "Unable to create Credentials instances: '.credentials.json' file not found"
            );
        }
        /** @var string $content */
        $content = file_get_contents(__DIR__ . '/_files/.credentials.json');
        try {
            /** @var array<int, array<string,mixed>> $data */
            $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
            // all values are correct
            $this->credentials[0] = new Credentials($data[0]['user'], $data[0]['password']);
            $this->account = new Account($data[0]['account']['name'], $data[0]['account']['id']);
            // all values are incorrect
            $this->credentials[1] = new Credentials($data[1]['user'], $data[1]['password']);
            // user is ok, password is invalid
            $this->credentials[2] = new Credentials($data[2]['user'], $data[2]['password']);
        } catch (\JsonException $e) {
            throw new \RuntimeException(
                "Unable to create Credentials instances: {$e->getMessage()}"
            );
        }
    }
}
