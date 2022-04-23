<?php

declare(strict_types=1);

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Helpers\NormalizeInput;
use Gam\Estafeta\Command\Model\Enum\LocationType;
use Gam\Estafeta\Command\Tokenized;

class Location implements Tokenized
{
    use NormalizeInput;

    private string $id;

    private LocationSection $sectionInfo;

    private Address $address;

    private LocationCategory $category;

    private string $acronymSquare;

    private LocationType $type;

    private Contact $contact;

    /**
     * @param string $id
     * @param LocationSection $sectionInfo
     * @param Address $address
     * @param LocationCategory $category
     * @param LocationType $type
     * @param Contact $contact
     * @param string $acronymSquare
     */
    public function __construct(
        string $id,
        LocationSection $sectionInfo,
        Address $address,
        LocationCategory $category,
        LocationType $type,
        Contact $contact,
        string $acronymSquare = ''
    ) {
        $this->id = $id;
        $this->sectionInfo = $sectionInfo;
        $this->address = $address;
        $this->category = $category;
        $this->acronymSquare = $acronymSquare;
        $this->type = $type;
        $this->contact = $contact;
    }

    /**
     * @param array<string, mixed> $properties
     * @return static self
     */
    public static function create(array $properties = []): self
    {
        //TODO: Implement
        throw new \BadMethodCallException('Not implemented yet');
    }

    /**
     * @return LocationType
     */
    public function getType(): LocationType
    {
        return $this->type;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return LocationSection
     */
    public function getSectionInfo(): LocationSection
    {
        return $this->sectionInfo;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return LocationCategory
     */
    public function getCategory(): LocationCategory
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getAcronymSquare(): string
    {
        return $this->acronymSquare;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        // var domicilioTextArea="Domicilio: "+calle1+" "+numExterior+" "+calle2+" "+numInterior+", "+"Col. "+colonia+" C.P. "+codigoPos+". "+municipio+" "+estado+". Tel. "+telefono + " Razón Social: "+razonSocial+ " Contacto: "+contacto+txtAreaRfc;
        return sprintf(
            'Domicilio: %s %s %s %s, Col. %s C.P. %s. %s %s. %s',
            $this->normalize($this->address->getFirstStreet()),
            $this->normalize($this->address->getStreetAddress()),
            $this->normalize($this->address->getSecondStreet()),
            $this->normalize($this->address->getApartmentNumber()),
            $this->normalize($this->sectionInfo->getSuburb()),
            $this->sectionInfo->getPostalCode(),
            $this->normalize($this->sectionInfo->getMunicipality()),
            $this->sectionInfo->getState(),
            $this->contact
        );
    }

    /**
     * @inheritDoc
     */
    public function delimiter(): string
    {
        return '|';
    }

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        // var domicilioCompleto=calle1+"|"+idDomi+"|"+calle2+"|"+idcategoria+"|"+categoria+"|"+siglasPlaza+"|"+colonia+"|"+contacto+"|"+correoE+"|"+correoOpc+"|"+estado+"|"+municipio+"|"+nombreCorto+"|"+numExterior+"|"+numInterior+"|"+idPais+"|"+pais+"|"+razonSocial+"|"+telefono+"|"+telefonoCel+"|"+codigoPos+"|"+latitud+"|"+longitud+"|"+rfc+"|";
        return [
            $this->normalize($this->address->getFirstStreet()),
            $this->id ?? '',
            $this->normalize($this->address->getSecondStreet()),
            $this->category->getId(),
            $this->category->getName(),
            $this->acronymSquare ?? '',
            $this->normalize($this->sectionInfo->getSuburb()),
            $this->normalize($this->contact->getContactName()),
            $this->contact->getEmail(),
            '', // other email
            $this->sectionInfo->getState(),
            $this->normalize($this->sectionInfo->getMunicipality()),
            $this->normalize($this->contact->getShortName()),
            $this->normalize($this->address->getStreetAddress()),
            $this->normalize($this->address->getApartmentNumber()),
            $this->sectionInfo->getCountry()->getId(),
            $this->normalize($this->sectionInfo->getCountry()->getName()),
            $this->normalize($this->contact->getRfc()->getLegalName()),
            $this->contact->getPhone()? $this->contact->getPhone()->getPhoneNumber() : '',
            $this->contact->getPhone()? $this->contact->getPhone()->getMobileNumber() : '',
            $this->sectionInfo->getPostalCode(),
            '', // latitude
            '', // longitude
            $this->type->getValue(),
            $this->contact->getRfc()->getRfc(),
        ];
    }
}
