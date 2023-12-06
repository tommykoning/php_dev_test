<?php

if(function_exists($_GET['f'])) {
  $_GET['f']($_REQUEST["q"]);
}

// takes number as value and calculates all its divisions except for itself and 1
function calcDivisor($num) {
  // the array all divisions will be saved in
  $divisorsArray = [];

  // a loop to see what the divisions of $q are
  for($i = 2; $i < $num; $i ++) {
    if ($num % $i == 0) {
      $divisorsArray[] = $i;
    }
  }

  // Output "this is a prime number" if there are no divisions
  echo sizeof($divisorsArray) === 0 ? "none this is a prime number" : json_encode($divisorsArray);
}

// take a number and between 0 and 13 and calculates its factorial value
function calcFractorial($num) {
  $fractorial = 1;
  // a loop to calculate the fractorial of $q
  if($num >= 1 && $num <= 12) {
  for($i = 1; $i <= $num; $i ++) {
      $fractorial = $fractorial*$i; 
  }
  echo json_encode($fractorial);
  } else {
  echo  $num < 13 ? "the input was less then 1" : "the input was more then 12";
  }
}

// creates a xml document and caluclates which 
function calcPrimeNumbers($numJson) {
  $numArray = json_decode($numJson, true);
  $amountOfPrimeNumbers = 0;

  $xml = new SimpleXMLElement('<xml/>');
  $primenumbers = $xml->addChild('primeNumbers');
  $results = $primenumbers->addChild('result');

  $xml->addAttribute('version', '1.0');
  $xml->addAttribute('encoding', 'UTF-8');

  foreach ($numArray as $number) {
    if(isPrime($number)) {
      $results->addchild('number', (string)$number);
      $amountOfPrimeNumbers++;
    }
  }

  $primenumbers->addAttribute('amount', $amountOfPrimeNumbers);

  echo $xml->asXml();
}

function isPrime($n){
  for($i=$n;--$i&&$n%$i;);return$i==1;
}

