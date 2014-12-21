<?php

namespace spec\Cocoders\MedicalClinic;

use Cocoders\MedicalClinic\Clinic\Address;
use Cocoders\MedicalClinic\Clinic\NationalEconomyRegisterNumber;
use Cocoders\MedicalClinic\Clinic\PatientCase;
use Cocoders\MedicalClinic\Clinic\Service;
use Cocoders\MedicalClinic\Clinic\TaxIdentificationNumber;
use Cocoders\MedicalClinic\Employee;
use Cocoders\MedicalClinic\Patient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClinicSpec extends ObjectBehavior
{
    function let(
        Address $address,
        Service $service,
        TaxIdentificationNumber $taxNumber,
        NationalEconomyRegisterNumber $nationalEconomyRegisterNumber
    )
    {
        $this->beConstructedWith(
            'Clinic name',
            $address,
            $servicesProvidedByClinic = [
                $service
            ],
            $taxNumber,
            $nationalEconomyRegisterNumber
        );
    }

    function it_cannot_be_initialized_at_least_one_service(
        Address $address,
        TaxIdentificationNumber $taxNumber,
        NationalEconomyRegisterNumber $nationalEconomyRegisterNumber
    )
    {
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', [
            'Clinic name',
            $address,
            $servicesProvidedByClinic = [],
            $taxNumber,
            $nationalEconomyRegisterNumber
        ]);
    }

    function it_allows_for_the_employment(Employee $employee)
    {
        $this->hasEmployee($employee)->shouldBe(false);
        $this->hireEmployee($employee);
        $this->hasEmployee($employee)->shouldBe(true);
    }

    function it_allows_register_patients(Patient $patient)
    {
        $patient->getIdNumber()->willReturn('80010104000');
        $patient->__toString()->willReturn('Kowalski Leszek (80010104000)');
        $this->registerPatient($patient, false);

        /**
         * @var PatientCase $patientCase
         */
        $patientCase = $this->findPatientCase('80010104000');
        $patientCase->getTitle()->shouldBe('Kowalski Leszek (80010104000)');
        $patientCase->getIdNumber()->shouldBe('80010104000');
        $patientCase->getVisitsQuantity()->shouldBe(1);
        $patientCase->canBeScheduledForVisit()->shouldBe(false);

        $this->registerPatient($patient, true);

        $patientCase = $this->findPatientCase('80010104000');
        $patientCase->getTitle()->shouldBe('Kowalski Leszek (80010104000)');
        $patientCase->getIdNumber()->shouldBe('80010104000');
        $patientCase->getVisitsQuantity()->shouldBe(2);
        $patientCase->canBeScheduledForVisit()->shouldBe(true);
    }
}
