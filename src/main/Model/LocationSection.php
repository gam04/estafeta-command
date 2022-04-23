<?php

namespace Gam\Estafeta\Command\Model;

/**
 * A LocationSection represents all Location divisions for a postal code.
 * <p> <b>country:</b>  ID and Text of Country (Pais) </p>
 * <p> <b>postalCode:</b>  Codigo Postal </p>
 * <p> <b>state:</b>  Estado </p>
 * <p> <b>municipality:</b>  Municipio </p>
 * <p> <b>suburb:</b>  Colonia </p>
 */
class LocationSection
{
    private string $postalCode;

    private Country $country;

    private string $state;

    private string $municipality;

    private string $suburb;

    /**
     * @param string $postalCode
     * @param Country $country
     * @param string $state
     * @param string $municipality
     * @param string $suburb
     */
    public function __construct(
        string $postalCode,
        Country $country,
        string $state,
        string $municipality,
        string $suburb
    ) {
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->state = $state;
        $this->municipality = $municipality;
        $this->suburb = $suburb;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getMunicipality(): string
    {
        return $this->municipality;
    }

    /**
     * @return string
     */
    public function getSuburb(): string
    {
        return $this->suburb;
    }
}
