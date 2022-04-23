<?php

namespace Gam\Estafeta\Command\Model;

class Account
{
    /**
     * @var string The Account owner's Legal name.
     */
    private string $name;

    /**
     * @var string The unique ID for the account.
     */
    private string $id;

    /**
     * @var Service[] A list of available services.
     */
    private array $services;

    /**
     * @var ContentType[] A list of available content types.
     */
    private array $contentTypes;

    /**
     * @param string $name
     * @param string $id
     * @param Service[] $services
     * @param ContentType[] $contentTypes
     */
    public function __construct(
        string $name,
        string $id,
        array $services = [],
        array $contentTypes = []
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->services = $services;
        $this->contentTypes = $contentTypes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @return ContentType[]
     */
    public function getContentTypes(): array
    {
        return $this->contentTypes;
    }

    /**
     * @param string $id
     * @return ContentType|null
     */
    public function getContentType(string $id): ?ContentType
    {
        $found = array_filter($this->contentTypes, function ($contentType) use ($id) {
            return $contentType->getId() === $id;
        });
        $found = array_values($found);
        return count($found) > 0? $found[0]: null;
    }

    /**
     * @param string $name
     * @return ContentType|null
     */
    public function getContentTypeByName(string $name): ?ContentType
    {
        $found = array_filter($this->contentTypes, function ($contentType) use ($name) {
            return $contentType->getName() === $name;
        });
        $found = array_values($found);
        return count($found) > 0? $found[0]: null;
    }

    /**
     * @param string $id
     * @return Service|null
     */
    public function getService(string $id): ?Service
    {
        $found = array_filter($this->services, function ($service) use ($id) {
            return $service->getId() === $id;
        });
        $found = array_values($found);
        return count($found) > 0? $found[0]: null;
    }

    public function getServiceByName(string $name): ?Service
    {
        $found = array_filter($this->services, function ($service) use ($name) {
            return $service->getName() === $name;
        });
        $found = array_values($found);
        return count($found) > 0? $found[0]: null;
    }

    public function hasServiceWithName(string $name): bool
    {
        return ! is_null($this->getServiceByName($name));
    }

    public function hasContentTypeWithName(string $name): bool
    {
        return ! is_null($this->getContentTypeByName($name));
    }
}
