<?php

namespace Gam\Estafeta\Command;

use Gam\Estafeta\Command\Exception\AuthException;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\BrowserKit\History;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Browser extends \Symfony\Component\BrowserKit\HttpBrowser
{
    public const BASE_URI = 'comando.estafeta.com';

    /**
     * The common http headers for all request.
     * @var array<string>
     */
    private const COMMON_HEADERS = [
        'HTTP_CONNECTION' => 'keep-alive',
        'HTTP_PRAGMA' => 'no-cache',
        'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0',
        'HTTP_HOST' => self::BASE_URI,
        'HTTPS' => 'on',
    ];

    /**
     * @var bool Indicate if the browser has a valid session in the portal
     */
    private bool $authenticated = false;

    public function __construct(HttpClientInterface $httpClient = null, History $history = null, CookieJar $cookieJar = null)
    {
        // HttpClient::createForBaseUri(self::BASE_URI) does not work
        parent::__construct($httpClient, $history, $cookieJar);
        $this->setServerParameters(self::COMMON_HEADERS);
    }

    /**
     * @throws AuthException
     */
    public function login(Credentials $credentials): void
    {
        // make this request to get a cookie
        $this->request('GET', '/ComandoWeb/');
        $authCrawler = $this->request(
            'POST',
            '/ComandoWeb/accesoSistema.do',
            [
                'dispatch' => 'doAcceso',
                'usuario' => $credentials->getUser(),
                'password' => $credentials->getPassword(),
            ],
            [], // files
            [
                'CONTENT-TYPE' => 'application/x-www-form-urlencoded', 'ACCEPT' => 'application/json', ],
        );
        try {
            $currentContent = $this->getResponse()->getContent();

            /** @var array<string> $parsed */
            $parsed = json_decode($currentContent, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new AuthException("Unable to parse the expected json body: {$e->getMessage()}");
        }
        // case 1. The user was found but password is incorrect
        // this case contains html content
        if (isset($parsed['mensajeError']) && ! empty($parsed['mensajeError'])) {
            throw new AuthException(strip_tags($parsed['mensajeError']));
        }
        // case 2. The user and password are incorrect
        if (isset($parsed['message']) && ! empty($parsed['message'])) {
            throw new AuthException($parsed['message']);
        }
        $this->authenticated = true;
    }

    /**
     * @return void
     * @throws AuthException
     */
    public function logout(): void
    {
        if (! $this->isAuthenticated()) {
            throw new AuthException('Cannot logout because the browser has no authenticated session');
        }
        $this->request('GET', '/ComandoWeb/Usuario.do?dispatch=doLogout');
        $this->restart();
        $this->authenticated = false;
    }

    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }
}
