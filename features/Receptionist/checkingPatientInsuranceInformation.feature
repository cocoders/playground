Feature: As a receptionist in the clinic,
  I would like arrange a visit to a doctor without worrying about whether patient is insured
  so I should be able to view and check such information in the system instead of calling insurance company

  Presumptions and rules:
  - Patient who is not insured can not have free visits (except emergencies)
  - We can fetch information about insurance from national insurance database which is available for clinic

  Scenario: Checking information for patient without insurance during medical visit arrangement
    Given I am receptionist in the clinic
    And patient does not have medical insurance
    When I am find and open that patient case
    Then I should see that the patient can not be scheduled for a medical visit because he is not insured

  Scenario: Checking information for patient with insurance during medical visit arrangement
    Given I am receptionist in the clinic
    And patient has medical insurance
    When I am find and open that patient case
    Then I should see that the patient can be scheduled for a medical visit