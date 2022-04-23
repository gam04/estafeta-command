<?php

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Helpers\NormalizeInput;
use Gam\Estafeta\Command\Helpers\Objects;
use Gam\Estafeta\Command\Model\Enum\CodType;
use Gam\Estafeta\Command\Model\Enum\PackagingType;
use Gam\Estafeta\Command\Tokenized;

class LabelParameters implements Tokenized
{
    use NormalizeInput;

    private Account $account;

    private Location $origin;

    private Location $destination;

    private Package $package;

    private Service $service;

    private ContentType $contentType;

    private PackagingType $packagingType;

    private PrintConfig $printConfig;

    /**
     * @var LabelReference|null
     */
    private ?LabelReference $reference;

    /**
     * @var CodType|null
     */
    private ?CodType $codType;

    /**
     * @var Frecuency
     */
    private Frecuency $frecuency;

    /**
     * @param Account $account
     * @param Location $origin
     * @param Location $destination
     * @param Package $package
     * @param Service $service
     * @param ContentType $contentType
     * @param PackagingType $packagingType
     * @param PrintConfig $printConfig
     * @param LabelReference|null $reference
     * @param CodType|null $codType
     */
    public function __construct(
        Account $account,
        Location $origin,
        Location $destination,
        Package $package,
        Service $service,
        ContentType $contentType,
        PackagingType $packagingType,
        PrintConfig $printConfig,
        LabelReference $reference = null,
        CodType $codType = null
    ) {
        $this->account = $account;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->package = $package;
        $this->service = $service;
        $this->contentType = $contentType;
        $this->packagingType = $packagingType;
        $this->printConfig = $printConfig;
        $this->reference = $reference;
        $this->codType = $codType;
        $this->frecuency = Frecuency::default();
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return Location
     */
    public function getOrigin(): Location
    {
        return $this->origin;
    }

    /**
     * @return Location
     */
    public function getDestination(): Location
    {
        return $this->destination;
    }

    /**
     * @return Package
     */
    public function getPackage(): Package
    {
        return $this->package;
    }

    /**
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType
    {
        return $this->contentType;
    }

    /**
     * @return PackagingType
     */
    public function getPackagingType(): PackagingType
    {
        return $this->packagingType;
    }

    /**
     * @return PrintConfig
     */
    public function getPrintConfig(): PrintConfig
    {
        return $this->printConfig;
    }

    /**
     * @return LabelReference|null
     */
    public function getReference(): ?LabelReference
    {
        return $this->reference;
    }

    /**
     * @return CodType|null
     */
    public function getCodType(): ?CodType
    {
        return $this->codType;
    }

    public function setDestinationFrecuency(Frecuency $frecuency): void
    {
        $this->frecuency = $frecuency;
    }

    public function delimiter(): string
    {
        return '$';
    }

    public function data(): array
    {
        $data = [
            $this->account->getId(), // Cliente ID
            $this->service->getName(), // Nombre servicio [Terrestre, Dia siguiente..]
            'Sin Servicio Adicional', // servicio adicional
            '', // servicio de retorno
            $this->normalize($this->origin->getContact()->getShortName()), // origen nombre corto
            $this->normalize($this->destination->getContact()->getShortName()), // destino nombre corto
            1, // No. de guias
            $this->normalize($this->package->getCostCenter()), // centro de costo
            $this->reference ? $this->normalize($this->reference->getReference()) : '', // referencia
            $this->contentType->getName(), // CAJA
            (number_format($this->package->getWeight(), 1)), // peso del paquete
            $this->packagingType->id(), // S, C
            $this->packagingType->getValue(), // Sobre, Paquete
            Objects::tokenize($this->origin),
            Objects::tokenize($this->destination),
            (string) $this->origin,
            (string) $this->destination,
            $this->service->getId(), // 72|1|NOR ...
            'NOR', // sin servicio adicional
            '', // tipo de servicio adicional
            '', // subtipo de servicio adicional
            '', // valor de entrega
            '', // descuento de valor de entrega
            $this->frecuency->warrantyValue(),
            $this->frecuency->ocursValue(),
            $this->frecuency->getReexp(),
            'false', // seguro opcional
            $this->normalize($this->package->getAdditionalInfo()),
            '', // descuento contenido
            '', // referencia COD
            '', // factura COD
            $this->contentType->getId(),
            $this->package->getDimension() ? $this->package->getDimension()->getLength() : '0', // largo
            $this->package->getDimension() ? $this->package->getDimension()->getHigh() : '0', // alto
            $this->package->getDimension() ? $this->package->getDimension()->getWidth() : '0', // ancho
            'P', //tipo entrega COD
        ];

        return $data;
    }
}
