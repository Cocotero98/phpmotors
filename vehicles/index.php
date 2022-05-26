<?php
    /*PHPMotors vehicles controller
    * This file is accessed at http://lvh.me/phpmotors/
    * or at http://lvh.me/phpmotors/index.php
    *
    * This file controls all traffic to the http://lvh.me/phpmotors/URL
    */

// Get the database connection file 
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

//
$classificationList = "<select id='classification' name='classificationId'><option>Choose Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
}
$classificationList .= "</select>";


    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action){
        case 'template':
            include 'view/template.php';
            break;
        case 'addclassification':
            include '../view/add-classification.php';
            break;
        case 'addClassification':
            $classificationName = filter_input(INPUT_POST, 'classificationName'); 
            if (empty($classificationName)){
                $message = '<p>Please, provide the required information</p>';
                include '../view/add-classification.php';
                exit;
            }
            $insertOutcome = addClassification($classificationName);
            if ($insertOutcome === 1){
                $message = "<p>$classificationName successfully added.</p>";
                include '../view/vehicle-management.php';
                exit;
            }else{
                $message = "<p>An error occured and $classificationName was not added. Please, try again.</p>";
                include '../view/add-classification.php';
                exit;
            }
            
            break;
        case 'addvehicle':
            include '../view/add-vehicle.php';
            break;
        case 'addVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');
            $classificationId = filter_input(INPUT_POST, 'classificationId');
            
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
                $message = '<p>Please, provide the required information</p>';
                include '../view/add-vehicle.php';
                exit;
            }
            $insrtVclOut = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
            if ($insrtVclOut === 1){
                $message = "<p>$invMake $invModel successfully added.</p>";
                include '../view/vehicle-management.php';
                exit;
            }else{
                $message = "<p>An error occured and $invMake $invModel was not added. Please, try again.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            
            break;
            
            break;
        default:
            include '../view/vehicle-management.php';
    }
