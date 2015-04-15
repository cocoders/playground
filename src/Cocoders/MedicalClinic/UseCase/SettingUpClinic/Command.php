<?php

namespace Cocoders\MedicalClinic\UseCase\SettingUpClinic;

final class Command
{
    public $name;
    public $postalCode;
    public $city;
    public $street;
    public $services = [];
    public $taxIdNumber;
    public $nationalRegistryNumber;

    public function __construct($name, $postalCode, $city, $street, $services, $taxIdNumber, $nationalRegistryNumber)
    {
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->street = $street;
        $this->services = $services;
        $this->taxIdNumber = $taxIdNumber;
        $this->nationalRegistryNumber = $nationalRegistryNumber;
    }
}