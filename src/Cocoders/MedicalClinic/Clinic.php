<?php

namespace Cocoders\MedicalClinic;

use Cocoders\MedicalClinic\Clinic\PatientCase;

class Clinic
{
    private $name;
    /**
     * @var Clinic\Address
     */
    private $address;
    /**
     * @var Clinic\Service[]
     */
    private $services;
    /**
     * @var Clinic\TaxIdentificationNumber
     */
    private $taxNumber;
    /**
     * @var Clinic\NationalEconomyRegisterNumber
     */
    private $nationalEconomyRegisterNumber;
    /**
     * @var Employee[]
     */
    private $employees = [];
    /**
     * @var Clinic\PatientCase[]
     */
    private $patientCases = [];

    public function __construct(
        $name,
        Clinic\Address $address,
        $services,
        Clinic\TaxIdentificationNumber $taxNumber,
        Clinic\NationalEconomyRegisterNumber $nationalEconomyRegisterNumber
    )
    {
        if (!$services) {
            throw new \InvalidArgumentException('Cannot create without any service');
        }

        $this->name = $name;
        $this->address = $address;
        $this->services = $services;
        $this->taxNumber = $taxNumber;
        $this->nationalEconomyRegisterNumber = $nationalEconomyRegisterNumber;
    }

    public function hasEmployee(Employee $employee)
    {
        return false !== array_search($employee, $this->employees);
    }

    public function hireEmployee(Employee $employee)
    {
        if (!$this->hasEmployee($employee)) {
            $this->employees[] = $employee;
        }
    }

    public function registerPatient(Patient $patient, $hasInsurance)
    {
        if ($case = $this->findPatientCase($patient->getIdNumber())) {
            $case->registerVisit($patient, $hasInsurance);
            return;
        }

        $this->patientCases[$patient->getIdNumber()] = new PatientCase($patient, $hasInsurance);
    }

    /**
     * @param $idNumber
     * @return Clinic\PatientCase
     */
    public function findPatientCase($idNumber)
    {
        if (isset($this->patientCases[$idNumber])) {
            return $this->patientCases[$idNumber];
        }
    }
}
