<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }
// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }
function checkFloat($float){
   $valFloat = filter_var($float, FILTER_VALIDATE_FLOAT);
   return $valFloat;
}
function checkInt($integer){
   $valInteger = filter_var($integer, FILTER_VALIDATE_INT);
   return $valInteger;
}
function createNav($classifications){
   $navList = '<ul>';
   $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
   foreach ($classifications as $classification) {
      $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
   }
$navList .= '</ul>';
return $navList;
}