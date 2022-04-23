<?php

namespace Gam\Estafeta\Command;

use Gam\Estafeta\Command\Exception\InvalidDataException;
use Gam\Estafeta\Command\Model\Account;
use Gam\Estafeta\Command\Model\ContentType;
use Gam\Estafeta\Command\Model\Enum\CodType;
use Gam\Estafeta\Command\Model\Enum\PackagingType;
use Gam\Estafeta\Command\Model\Enum\PaperType;
use Gam\Estafeta\Command\Model\Enum\PrintType;
use Gam\Estafeta\Command\Model\LabelParameters;
use Gam\Estafeta\Command\Model\LabelReference;
use Gam\Estafeta\Command\Model\Location;
use Gam\Estafeta\Command\Model\Package;
use Gam\Estafeta\Command\Model\PrintConfig;
use Gam\Estafeta\Command\Model\Service;

/**
 * Builder instance for {@see LabelParameters}.
 */
class LabelParametersBuilder
{
    /** @var Account $account */
    private Account $account;

    /** @var Location $origin */
    private Location $origin;

    /** @var Location $destination */
    private Location $destination;

    /** @var Package $package */
    private Package $package;

    /** @var Service $service */
    private Service $service;

    /** @var ContentType $contentType */
    private ContentType $contentType;

    /** @var PackagingType $packagingType */
    private PackagingType $packagingType;

    /** @var PrintConfig $printConfig */
    private PrintConfig $printConfig;

    /** @var null|LabelReference $reference */
    private ?LabelReference $reference;

    /** @var null|CodType $codType */
    private ?CodType $codType;

    public function __construct()
    {
        $this->codType = null;
        $this->reference = null;
        $this->printConfig = new PrintConfig(PrintType::LOCAL(), PaperType::BOND());
    }

    /**
     * @param Account $account Set account property.
     * @return $this Builder instance.
     */
    public function withAccount(Account $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @param Location $origin Set origin property.
     * @return $this Builder instance.
     */
    public function withOrigin(Location $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @param Location $destination Set destination property.
     * @return $this Builder instance.
     */
    public function withDestination(Location $destination): self
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param Package $package Set package property.
     * @return $this Builder instance.
     */
    public function withPackage(Package $package): self
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @param Service $service Set service property.
     * @return $this Builder instance.
     */
    public function withService(Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @param ContentType $contentType Set contentType property.
     * @return $this Builder instance.
     */
    public function withContentType(ContentType $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @param PackagingType $packagingType Set packagingType property.
     * @return $this Builder instance.
     */
    public function withPackagingType(PackagingType $packagingType): self
    {
        $this->packagingType = $packagingType;
        return $this;
    }

    /**
     * @param PrintConfig $printConfig Set printConfig property.
     * @return $this Builder instance.
     */
    public function withPrintConfig(PrintConfig $printConfig): self
    {
        $this->printConfig = $printConfig;
        return $this;
    }

    /**
     * @param LabelReference $reference Set reference property.
     * @return $this Builder instance.
     */
    public function withReference(LabelReference $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param CodType $codType Set codType property.
     * @return $this Builder instance.
     */
    public function withCodType(CodType $codType): self
    {
        $this->codType = $codType;
        return $this;
    }

    /**
     * Validate the builder instance.
     *
     * @throws InvalidDataException
     */
    private function validate(): void
    {
        $this->notNullValidation();
    }

    /**
     * @return LabelParameters New instance from Builder.
     * @throws InvalidDataException
     */
    public function build(): LabelParameters
    {
        $this->validate();

        return new LabelParameters(
            $this->account,
            $this->origin,
            $this->destination,
            $this->package,
            $this->service,
            $this->contentType,
            $this->packagingType,
            $this->printConfig,
            $this->reference,
            $this->codType
        );
    }

    /**
     * @throws InvalidDataException
     */
    private function notNullValidation(): void
    {
        $properties = [
            'account',
            'origin',
            'destination',
            'package',
            'service',
            'contentType',
            'packagingType',
        ];
        foreach ($properties as $property) {
            if (empty($this->{$property})) {
                throw new InvalidDataException("$property must no be empty or null");
            }
        }
    }
}
