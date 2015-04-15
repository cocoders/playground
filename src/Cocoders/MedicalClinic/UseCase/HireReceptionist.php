<?php

namespace Cocoders\MedicalClinic\UseCase;

use Cocoders\MedicalClinic\Clinic\TaxIdentificationNumber;
use Cocoders\MedicalClinic\ClinicRegistry;
use Cocoders\MedicalClinic\Employee\Receptionist;

class HireReceptionist
{
    /**
     * @var ClinicRegistry
     */
    private $registry;

    public function __construct(ClinicRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function execute(HireReceptionist\Command $command)
    {
        $clinic = $this->registry->find(new TaxIdentificationNumber($command->taxIdNumber));

        if (!$clinic) {
            throw new \InvalidArgumentException(
                sprintf('Cannot find clinic with following tax id numer %s', $command->taxIdNumber)
            );
        }

        $clinic->hireEmployee(new Receptionist(
            $command->firstName,
            $command->lastName,
            $command->idNumber
        ));

        $this->registry->add($clinic);
    }
}
