<?php

namespace spec\Cocoders\MedicalClinic;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PatientSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($idNumber = '70081012345', $firstName = 'Leszek', $lastName = 'Kowalski');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Cocoders\MedicalClinic\Patient');
    }

    function it_has_id_number()
    {
        $this->getIdNumber()->shouldBe('70081012345');
    }

    function it_has_first_name()
    {
        $this->getFirstName()->shouldBe('Leszek');
    }

    function it_has_last_name()
    {
        $this->getLastName()->shouldBe('Kowalski');
    }
}
