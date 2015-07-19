<?php

namespace Cocoders\Adapters\Doctrine;

use Cocoders\MedicalClinic\Clinic;
use Cocoders\MedicalClinic\ClinicRegistry as ClinicRegistryInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class ClinicRegistry implements ClinicRegistryInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function add(Clinic $clinic)
    {
        $this->manager->persist($clinic);
        $this->manager->flush($clinic);
    }

    /**
     * @param Clinic\TaxIdentificationNumber $taxIdentificationNumber
     * @return Clinic
     */
    public function find(Clinic\TaxIdentificationNumber $taxIdentificationNumber)
    {
        return $this
            ->manager
            ->getRepository(Clinic::class)
            ->findOneBy(['taxNumber' => (string) $taxIdentificationNumber])
        ;
    }
}