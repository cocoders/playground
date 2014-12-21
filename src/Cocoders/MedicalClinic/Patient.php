<?php

namespace Cocoders\MedicalClinic;

class Patient
{
    private $idNumber;
    private $firstName;
    private $lastName;

    public function __construct($idNumber, $firstName, $lastName)
    {
        $this->idNumber = $idNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getIdNumber()
    {
        return $this->idNumber;
    }

    public function __toString()
    {
        return sprintf('%s %s (%s)', $this->lastName, $this->firstName, $this->idNumber);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }
}
