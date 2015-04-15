<?php

namespace Cocoders\MedicalClinic\UseCase\HireReceptionist;

final class Command
{
    public $taxIdNumber;
    public $firstName;
    public $lastName;
    public $idNumber;

    public function __construct($taxIdNumber, $firstName, $lastName, $idNumber)
    {
        $this->taxIdNumber = $taxIdNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->idNumber = $idNumber;
    }
}