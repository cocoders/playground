<?php

namespace spec\Cocoders\MedicalClinic\UseCase;

use Cocoders\MedicalClinic\Clinic;
use Cocoders\MedicalClinic\Clinic\TaxIdentificationNumber;
use Cocoders\MedicalClinic\ClinicRegistry;
use Cocoders\MedicalClinic\Employee;
use Cocoders\MedicalClinic\UseCase\HireReceptionist;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HireReceptionistSpec extends ObjectBehavior
{
    function let(ClinicRegistry $registry)
    {
        $this->beConstructedWith($registry);
    }

    function it_hire_receptionist_employee_in_the_clinic(ClinicRegistry $registry, Clinic $clinic)
    {
        $registry->find(new TaxIdentificationNumber('123-456-32-18'))->willReturn($clinic);
        $clinic->hireEmployee(Argument::type(Employee::class))->shouldBeCalled();
        $registry->add($clinic)->shouldBeCalled();

        $this->execute(new HireReceptionist\Command(
            $taxIdNumber = '123-456-32-18',
            $receptionistFirstName = 'Leszek',
            $receptionistLastName = 'Prabucki',
            $receptionistIdNumber = '80010104000'
        ));
    }

    function it_cannot_hire_receptionist_when_clinic_is_not_found_in_the_registry(ClinicRegistry $registry)
    {
        $registry->find(new TaxIdentificationNumber('123-456-32-18'))->willReturn(null);

        $this->shouldThrow('\InvalidArgumentException')->duringExecute(new HireReceptionist\Command(
            $taxIdNumber = '123-456-32-18',
            $receptionistFirstName = 'Leszek',
            $receptionistLastName = 'Prabucki',
            $receptionistIdNumber = '80010104000'
        ));
    }
}
