<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Cocoders\Adapters\InMemory\MedicalClinic\ClinicRegistry;
use Cocoders\MedicalClinic\Clinic;
use Cocoders\MedicalClinic\Patient;
use Cocoders\MedicalClinic\Employee\Receptionist;
use Cocoders\MedicalClinic\UseCase\SettingUpClinic;

class MedicalClinicContext implements SnippetAcceptingContext
{
    private $clinic;
    private $receptionist;
    private $patientCase;

    public function __construct()
    {
        $clinicRegistry = new ClinicRegistry();

        $settingUpClinic  = new SettingUpClinic($clinicRegistry);
        $settingUpClinic->execute(new SettingUpClinic\Command(
            $name = 'Clinic name',
            $postalCode = '80-283',
            $city = 'Gdańsk',
            $street = 'Królewskie Wzgórze',
            $services = [
                'MRI',
                'CT'
            ],
            $taxIdNumber = '123-456-32-18',
            $nationalRegistryNumber= '123456785'
        ));

        $this->clinic = $clinicRegistry->find(new Clinic\TaxIdentificationNumber($taxIdNumber));
    }

    /**
     * @Given I am receptionist in the clinic
     */
    public function iAmReceptionistInTheClinic()
    {
        $this->receptionist = new Receptionist(
            $firstName = 'Jan',
            $lastName = 'Kowalski',
            $idNumber = '80081012345'
        );
        $this->clinic->hireEmployee($this->receptionist);
    }

    /**
     * @Given patient does not have medical insurance
     */
    public function patientDoesNotHaveMedicalInsurance()
    {
        $patient = new Patient($idNumber = '70081012345', $firstName = 'Leszek', $lastName = 'Kowalski');

        $this->clinic->registerPatient($patient, $hasInsurance = false);
    }

    /**
     * @When I am find and open that patient case
     */
    public function iAmFindAndOpenThatPatientCase()
    {
        $patientCase = $this->clinic->findPatientCase($idNumber = '70081012345');
        if (!$patientCase) {
            throw new \LogicException(sprintf('Cannot find patient with %s id number', $idNumber));
        }

        $this->patientCase = $patientCase;
    }

    /**
     * @Then I should see that the patient can not be scheduled for a medical visit because he is not insured
     */
    public function iShouldSeeThatThePatientCanNotBeScheduledForAMedicalVisitBecauseHeIsNotInsured()
    {
        if ($this->patientCase->canBeScheduledForVisit()) {
            throw new \LogicException('Patient can be scheduled');
        }
    }

    /**
     * @Given patient has medical insurance
     */
    public function patientHasMedicalInsurance()
    {
        $patient = new Patient($idNumber = '70081012345', $firstName = 'Leszek', $lastName = 'Kowalski');
        $this->clinic->registerPatient($patient, $hasInsurance = true);
    }

    /**
     * @Then I should see that the patient can be scheduled for a medical visit
     */
    public function iShouldSeeThatThePatientCanBeScheduledForAMedicalVisit()
    {
        if (!$this->patientCase->canBeScheduledForVisit()) {
            throw new \LogicException('Patient cannot be scheduled');
        }
    }
}
