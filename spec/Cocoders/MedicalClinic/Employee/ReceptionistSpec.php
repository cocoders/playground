<?php

namespace spec\Cocoders\MedicalClinic\Employee;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReceptionistSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Jan', 'Kowalski', '80081012345');
    }

    function it_is_clinic_employee()
    {
        $this->shouldHaveType('Cocoders\MedicalClinic\Employee');
    }
}
