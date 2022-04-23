<?php

namespace Gam\Estafeta\Command\Test;

use Gam\Estafeta\Command\Browser;
use Symfony\Component\BrowserKit\HttpBrowser;

class BrowserTest extends TestCase
{
    /**
     * @var Browser
     */
    private Browser $estafetaBrowser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->estafetaBrowser = new Browser();
    }

    /**
     * @test
     */
    public function extendHttpBrowser(): void
    {
        self::assertInstanceOf(HttpBrowser::class, $this->estafetaBrowser);
    }

    /**
     * @test
     */
    public function commonRequestHeadersAreMeet(): void
    {
        $this->estafetaBrowser->request('GET', 'https://www.google.com/');
        self::assertEquals(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0',
            $this->estafetaBrowser->getServerParameter('HTTP_USER_AGENT')
        );
    }

    /**
     * @test Case 1. The user and password are valid
     * @throws \Exception
     */
    public function loginWithValidCredentials(): void
    {
        $this->estafetaBrowser->login($this->validCredential());
        $authenticated = $this->estafetaBrowser->isAuthenticated();
        $this->estafetaBrowser->logout();
        self::assertTrue($authenticated);
    }

    /**
     * @test Case 2. The user and password are invalid.
     * @throws \Exception
     */
    public function loginWithInvalidCredentials(): void
    {
        $this->expectExceptionMessage(
            'Error. El usuario y/o la contraseña son incorrectos, favor de verificar.'
        );
        $this->estafetaBrowser->login($this->invalidCredential());
    }

    /**
     * @test Case 3. The user is ok, password is invalid.
     * @throws \Exception
     */
    public function loginWithInvalidUser(): void
    {
        $this->expectExceptionMessage(
            'Sus datos de acceso son incorrectos' .
            '.¿Ha olvidado su contraseña?Usted puede restablecerla haciendo clic AQUI'
        );
        $this->estafetaBrowser->login($this->invalidPasswordCredential());
    }

    /**
     * @test Logout functionalty with valid session
     * @throws \Exception
     */
    public function logoutWithValidSession(): void
    {
        $this->estafetaBrowser->login($this->validCredential());
        $this->estafetaBrowser->logout();
        self::assertFalse($this->estafetaBrowser->isAuthenticated());
    }

    /**
     * @after
     */
    public function clean(): void
    {
        $this->estafetaBrowser->restart();
    }
}
