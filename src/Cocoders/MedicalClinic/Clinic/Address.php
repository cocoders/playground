<?php

namespace Cocoders\MedicalClinic\Clinic;

class Address
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
}
