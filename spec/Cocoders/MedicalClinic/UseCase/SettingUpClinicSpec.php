<?php

namespace spec\Cocoders\MedicalClinic\UseCase;

use Cocoders\MedicalClinic\Clinic;
use Cocoders\MedicalClinic\ClinicRegistry;
use Cocoders\MedicalClinic\UseCase\SettingUpClinic;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SettingUpClinicSpec extends ObjectBehavior
{
    function let(ClinicRegistry $registry)
    {
        $this->beConstructedWith($registry);
    }

    function it_adds_new_clinic_into_registry(ClinicRegistry $registry)
    {
        $registry->add(Argument::type(Clinic::class))->shouldBeCalled();

        $this->execute(new SettingUpClinic\Command(
            $name = 'Clinic name',
            $postalCode = '80-283',
            $city = 'Gdańsk',
            $street = 'Królewskie Wzgórze 21/9',
            $services = [
                'MRI',
                'CT'
            ],
            $taxIdNumber = '123-456-32-18',
            $nationalRegistryNumber= '123456785'
        ));
    }
}
