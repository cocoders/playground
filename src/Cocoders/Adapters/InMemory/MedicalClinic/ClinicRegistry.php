<?php

namespace Cocoders\Adapters\InMemory\MedicalClinic;

use Cocoders\MedicalClinic\Clinic;
use Cocoders\MedicalClinic\ClinicRegistry as ClinicRegistryInterface;
use Everzet\PersistedObjects\CallbackObjectIdentifier;
use Everzet\PersistedObjects\InMemoryRepository;

final class ClinicRegistry implements ClinicRegistryInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = new InMemoryRepository(new CallbackObjectIdentifier(function (Clinic $clinic) {
            return (string) $clinic->getTaxIdNumber();
        }));
    }

    public function add(Clinic $clinic)
    {
        $this->repository->save($clinic);
    }

    public function find(Clinic\TaxIdentificationNumber $taxIdentificationNumber)
    {
        return $this->repository->findById((string) $taxIdentificationNumber);
    }
}