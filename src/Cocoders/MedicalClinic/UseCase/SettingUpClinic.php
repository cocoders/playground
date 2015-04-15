<?php

namespace Cocoders\MedicalClinic\UseCase;

use Cocoders\MedicalClinic\Clinic;
use Cocoders\MedicalClinic\ClinicRegistry;

class SettingUpClinic
{
    /**
     * @var ClinicRegistry
     */
    private $registry;

    public function __construct(ClinicRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function execute(SettingUpClinic\Command $command)
    {
        $services = array_map(function ($serviceName) {
            return new Clinic\Service($serviceName);
        }, $command->services);

        $clinic = new Clinic(
            $command->name,
            new Clinic\Address(
                $command->postalCode,
                $command->city,
                $command->street
            ),
            $services,
            new Clinic\TaxIdentificationNumber($command->taxIdNumber),
            new Clinic\NationalEconomyRegisterNumber($command->nationalRegistryNumber)
        );

        $this->registry->add($clinic);
    }
}
