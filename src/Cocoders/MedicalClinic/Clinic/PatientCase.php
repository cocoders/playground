<?php

namespace Cocoders\MedicalClinic\Clinic;

use Cocoders\MedicalClinic\Patient;

class PatientCase
{
    private $idNumber;
    private $title;
    private $registeredVists = [];
    private $hasActualInsurance;

    public function __construct(Patient $patient, $hasInsurance)
    {
        $this->idNumber = $patient->getIdNumber();
        $this->title = (string) $patient;

        $this->registerVisit($patient, $hasInsurance);
    }

    public function registerVisit(Patient $patient, $hasInsurance)
    {
        if ($this->idNumber === $patient->getIdNumber()) {
            $this->registeredVists[] = [
                'date' => new \DateTime(),
                'hasInsurance' => $hasInsurance,
                'title' => (string) $patient
            ];
            $this->title = (string) $patient;
            $this->hasActualInsurance = $hasInsurance;
        }
    }

    public function getVisitsQuantity()
    {
        return count($this->registeredVists);
    }

    public function getIdNumber()
    {
        return $this->idNumber;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function canBeScheduledForVisit()
    {
        return $this->hasActualInsurance;
    }
}
