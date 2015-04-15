<?php

namespace Cocoders\MedicalClinic\Clinic;

final class NationalEconomyRegisterNumber
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function __toString()
    {
        return (string) $this->number;
    }
}
