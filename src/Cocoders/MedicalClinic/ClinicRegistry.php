<?php

namespace Cocoders\MedicalClinic;

interface ClinicRegistry
{
    public function add(Clinic $clinic);
    public function find(Clinic\TaxIdentificationNumber $taxIdentificationNumber);
}