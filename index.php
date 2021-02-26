<?php

include "InputValidator.php";
include "InputValidationException.php";

$inputValidator = new InputValidator();

echo $inputValidator->validateInput("[{()}]")."<br>";
echo $inputValidator->validateInput("{[]{}(})")."<br>";
echo $inputValidator->validateInput("{[]{}(((((({{{{{{[[[[[)")."<br>";
echo $inputValidator->validateInput("()(({{{[[[(")."<br>";
echo $inputValidator->validateInput("(((((((")."<br>";
echo $inputValidator->validateInput("))))))(")."<br>";
echo $inputValidator->validateInput("+**/test))))))(")."<br>";

/* Output */

/*
Başarılı
Başarısız
Çok Fazla Kapanmamış Parantez Var
Başarısız
Başarısız
Başarısız
Hatalı Parametre
*/