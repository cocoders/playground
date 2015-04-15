<?php

namespace Cocoders\MedicalClinic;

abstract class Employee
{
    private $firstName;
    private $lastName;
    private $idNumber;

    public function __construct($firstName, $lastName, $idNumber)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->idNumber = $idNumber;
    }

    public function hasIdNumber($idNumber)
    {
        return $this->idNumber == $idNumber;
    }
}
