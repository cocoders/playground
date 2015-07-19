<?php

namespace Cocoders\MedicalClinic;

class Clinic
{
    private $name;
    /**
     * @var Employee[]
     */
    private $employees = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function hasEmployee(Employee $employee)
    {
        return $this->employees->contains($employee);
    }

    public function hireEmployee(Employee $employee)
    {
        if (!$this->hasEmployee($employee)) {
            $this->employees[] = $employee;
        }
    }
}
