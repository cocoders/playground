<?php

namespace Cocoders\MedicalClinic\Clinic;

final class Address
{
    private $postalCode;
    private $city;
    private $street;

    public function __construct(
        $postalCode,
        $city,
        $street
    )
    {
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->street = $street;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getStreet()
    {
        return $this->street;
    }
}
