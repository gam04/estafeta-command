<?php

/** @noinspection JsonEncodingApiUsageInspection */

namespace Gam\Estafeta\Command;

use Gam\Estafeta\Command\Exception\AuthException;
use Gam\Estafeta\Command\Exception\CommandException;
use Gam\Estafeta\Command\Helpers\Objects;
use Gam\Estafeta\Command\Helpers\Strings;
use Gam\Estafeta\Command\Model\Account;
use Gam\Estafeta\Command\Model\ContentType;
use Gam\Estafeta\Command\Model\Country;
use Gam\Estafeta\Command\Model\Frecuency;
use Gam\Estafeta\Command\Model\Label;
use Gam\Estafeta\Command\Model\LabelParameters;
use Gam\Estafeta\Command\Model\LocationCategory;
use Gam\Estafeta\Command\Model\LocationSection;
use Gam\Estafeta\Command\Model\Service;
use Symfony\Component\BrowserKit\Response;

class Command
{
    /**
     * @var Browser The browser instance to perform the requests
     */
    private Browser $browser;

    /**
     * @var Credentials The Credentials to login into portal
     */
    private Credentials $credentials;

    /**
     * @var Account The Estafeta Command Account.
     */
    private Account $account;

    /**
     * @throws AuthException If the given credentials are invalid
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
        $this->browser = new Browser();
        $this->browser->login($credentials);
    }

    /**
     * Query the Section matching the given postal code.
     * @throws CommandException
     */
    public function fetchSections(string $postalCode): SectionList
    {
        $data = $this->makeXmlHttpRequest(
            ['dispatch' => 'buscarDatosPorCP', 'CP' => $postalCode],
            'domicilio.do'
        )[0];
        $sections = [];
        foreach ($data as $datum) {
            $sections[] = new LocationSection(
                $postalCode,
                Country::MEXICO(),
                $datum['estado'][0],
                $datum['municipio'][0],
                $datum['colonia'][0]
            );
        }
        return new SectionList(...$sections);
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    /**
     * Create a Label using the 'Estafeta Command'
     *
     * @param LabelParameters $parameters
     * @return Label
     * @throws CommandException If the label was not created.
     */
    public function createLabel(LabelParameters $parameters): Label
    {
        $post = $this->labelParametersForm($parameters);
        $data = $this->makeXmlHttpRequest($post, 'impresion.do')[0];
        if (! isset($data['archivo'])) {
            throw new CommandException("Unable to create the label. 'archivo' was not found");
        }
        return new Label(
            $data['archivo'],
            'Guia generada',
            $this->fetchLabelPdf($data['archivo'])
        );
    }

    /**
     * Get the PDF content of the Label with the given ID.
     *
     * @param string $id
     * @return string
     * @throws CommandException
     */
    public function fetchLabelPdf(string $id): string
    {
        $this->browser->request(
            'GET',
            "/ComandoWeb/impresion.do?dispatch=doMostrarPDF&nombrearchivo=$id"
        );

        $response = $this->browser->getResponse();

        if (200 !== $response->getStatusCode()) {
            throw new CommandException('PDF not found');
        }

        return $response->getContent();
    }

    /**
     * @throws CommandException
     */
    public function fetchFrecuency(string $postalCode, Service $service): Frecuency
    {
        $data = $this->makeXmlHttpRequest([
            'dispatch' => 'forFrecuenciaEntrega',
            'codigoPostal' => $postalCode,
            'idServicio' => $service->getId(),
        ], 'impresion.do')[0];

        return Frecuency::fromJsonResponse($data);
    }

    /**
     * @return LocationCategory[]
     * @throws CommandException
     */
    public function fetchLocationCategories(): array
    {
        $data = $this->makeXmlHttpRequest([
            'dispatch' => 'obtenerArrayCategorias',
            'estatus' => '1',
        ], 'categoria.do')[0];

        $categories = [];
        foreach ($data as $datum) {
            $categories[] = new LocationCategory($datum[0], $datum[1]);
        }
        return $categories;
    }

    /**
     * @return Account
     * @throws CommandException
     */
    public function fetchAccount(): Account
    {
        $idData = $this->fetchId();
        $services = $this->fetchServices($idData['id']);
        $contentTypes = $this->fetchContentTypes();

        $this->account = new Account(
            $idData['name'],
            $idData['id'],
            $services,
            $contentTypes
        );
        return $this->account;
    }

    /**
     * @throws CommandException
     * @return string[]
     */
    public function fetchId(): array
    {
        // {"objectResponse":[[["000000","000000-GRUPO SODB SA DE CV"]]],"success":["done!"]}
        // just the first account
        $idData = $this->makeXmlHttpRequest(
            ['dispatch' => 'forListaCuentasCliente'],
            'impresion.do'
        )[0][0];
        return ['id' => $idData[0], 'name' => $idData[1]];
    }

    /**
     * @throws CommandException
     * @return Service[]
     */
    public function fetchServices(string $idClient): array
    {
        $servicesData = $this->makeXmlHttpRequest(
            ['dispatch' => 'forListaServicios', 'idNumCte' => $idClient],
            'impresion.do'
        )[0];
        $services = [];
        foreach ($servicesData as $service) {
            $services[] = new Service($service[1], $service[0]);
        }
        return $services;
    }

    /**
     * @return ContentType[]
     * @throws CommandException
     */
    public function fetchContentTypes(): array
    {
        $contentTypesData = $this->makeXmlHttpRequest(
            ['dispatch' => 'forListaContenidos'],
            'impresion.do'
        )[0];
        $contentTypes = [];
        foreach ($contentTypesData as $contentType) {
            $contentTypes[] = new ContentType($contentType[0], $contentType[1]);
        }
        return $contentTypes;
    }

    /**
     * @return Credentials
     */
    public function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    /**
     * Destroy the session. Use this function when you no longer need to do
     * any more operations in the command.
     * @throws AuthException
     */
    public function logout(): void
    {
        $this->browser->logout();
    }

    /**
     * @param array<string, string> $data
     * @param string $endpoint
     * @return array<int, mixed>
     * @throws CommandException
     */
    private function makeXmlHttpRequest(array $data, string $endpoint): array
    {
        $crawler = $this->browser->xmlHttpRequest(
            'POST',
            "/ComandoWeb/$endpoint",
            $data,
            [], // files
            ['CONTENT-TYPE' => 'application/x-www-form-urlencoded; charset=UTF-8', 'ACCEPT' => '*/*']
        );

        /** @var Response $response */
        $response = $this->browser->getResponse();

        if (200 !== $response->getStatusCode()) {
            throw new CommandException('failed to read the response');
        }
        $content = $response->getContent();

        // If it's not already UTF-8, convert to it
        if (! Strings::isUtf8($content)) {
            $content = Strings::toUtf8($content, 'iso-8859-1');
        }

        /** @var array<string, mixed> $parsed */
        $parsed = json_decode($content, true);

        if (! isset($parsed['objectResponse'])) {
            $error = $parsed['failure'] ?? [];
            throw new CommandException('Unable to get object response', $error);
        }

        return $parsed['objectResponse'];
    }

    /**
     * @param LabelParameters $parameters
     * @return array<string, string>
     * @throws CommandException
     */
    private function labelParametersForm(LabelParameters $parameters): array
    {
        $destinationCp = $parameters->getDestination()
            ->getSectionInfo()
            ->getPostalCode();

        $frecuency = $this->fetchFrecuency($destinationCp, $parameters->getService());
        $parameters->setDestinationFrecuency($frecuency);

        return [
            'dispatch' => 'doImprimeGuias',
            'registro' => Objects::tokenize($parameters),
            'tipoPapel' => (string) $parameters->getPrintConfig()->getPaperType(),
            'tipoImpresion' => (string) $parameters->getPrintConfig()->getPrintType(),
            'numCliente' => $parameters->getAccount()->getId(),
            'correoE' => '', // default
            'cuadrante' => '', // default
            'impresionAcuse' => 'false', // default
            'impresora' => 'DATAMAX', // default
            'tipoImpTer' => 'PDF', // default
        ];
    }
}
