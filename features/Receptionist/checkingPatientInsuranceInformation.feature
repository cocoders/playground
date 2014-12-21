# language: pl

Potrzeba biznesowa: Jako recepcjonista w przychodni,
  Chciałbym umówić pacjenta na wizytę bez martwienia się czy jest on ubezpieczony dlatego
  powinienem być w stanie zobaczyć lub sprawdzić taką informacje w systemie, zamiast narażać
  przychodnię na stratę poprzez przyjęcie nieubezpieczonego pacjenta

  Dodatkowe informacje:
  - Pacjent który nie jest ubezpieczony nie może się leczyć w przychodni (poza nagłymi przypadkami)
  - Przychodnia ma nadane konto w systemie eWuŚ

  Scenariusz: Informacja o tym że pacjent nie jest ubezpieczony
    Zakładając że jestem recepcjonistą w przychodni
    I pacjent któremu rezerwuje wizytę nie ma ubezpieczenia
    Kiedy znajdę teczkę tego pacjenta w systemie
    Wtedy powinienem zobaczyć że dany pacjent nie może być umówiony na wizytę ponieważ nie jest ubezpieczony

  Scenariusz: Informacja o tym że pacjent jest ubezpieczony i może być przyjęty na wizytę lekarską
    Zakładając że jestem recepcjonistą w przychodni
    I pacjent któremu rezerwuje wizytę jest ubezpieczony
    Kiedy znajdę teczkę tego pacjenta w systemie
    Wtedy powinienem zobaczyć że dany pacjent może być umówiony na wizytę
