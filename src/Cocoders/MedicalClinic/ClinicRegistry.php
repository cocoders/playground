<?php

namespace Cocoders\MedicalClinic;

interface ClinicRegistry
{
    public function add(Clinic $clinic);

    /**
     * @param Clinic\TaxIdentificationNumber $taxIdentificationNumber
     * @return Clinic
     */
    public function find(Clinic\TaxIdentificationNumber $taxIdentificationNumber);
}