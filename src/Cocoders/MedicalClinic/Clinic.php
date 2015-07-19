<?php

namespace Cocoders\MedicalClinic;

use Cocoders\MedicalClinic\Clinic\PatientCase;
use Cocoders\MedicalClinic\Clinic\TaxIdentificationNumber;
use Cocoders\MedicalClinic\Employee\Receptionist;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var string
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
        $this->taxNumber = (string) $taxNumber;
        $this->nationalEconomyRegisterNumber = $nationalEconomyRegisterNumber;
        $this->employees = new ArrayCollection();
    }

    public function getTaxIdNumber()
    {
        return new TaxIdentificationNumber($this->taxNumber);
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

    public function registerPatient(Patient $patient, $receptionistId, $hasInsurance)
    {
        $isReceptionist = (boolean) $this->employees->filter(function (Employee $employee) use ($receptionistId) {
            return $employee instanceof Receptionist && $employee->hasIdNumber($receptionistId);
        })->first();

        if (!$isReceptionist)  {
           throw new \InvalidArgumentException(sprintf('%s is not receptionist', $receptionistId));
        }

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
