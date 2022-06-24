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
   $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
   foreach ($classifications as $classification) {
      $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
   }
$navList .= '</ul>';
return $navList;
}
// Build the classifications select list 
function buildClassificationList($classifications){ 
   $classificationList = '<select name="classificationId" id="classificationList">'; 
   $classificationList .= "<option>Choose a Classification</option>"; 
   foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
   } 
   $classificationList .= '</select>'; 
   return $classificationList; 
  }

// This function will build a display of vehicles within an unordered list.
function buildVehiclesDisplay($vehicles){
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<a href='/phpmotors/vehicles/?action=details&invId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
    $dv .= "<span>$vehicle[invPrice]</span>";
    $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
  }

  function buildDetailsDisplay($details){
   $detail = $details[0];
   $dd = "<img src=$detail[invImage] alt='$detail[invMake] $detail[invModel]'>";
   $dd .="<div><h1>$detail[invMake] $detail[invModel]</h1>";
   $dd .= "<h2>$".number_format($detail['invPrice'],0)."</h2>";
   $dd .= "<p>$detail[invDescription]</p>";
   $dd .= "<p>Color: $detail[invColor]</p>";
   $dd .= "<p>Stock: $detail[invStock]</p>";
   $dd .= "<a href='/phpmotors/vehicles/?action=details&invId=$detail[invId]'>Buy Now</a></div>";
   return $dd;
   }
  