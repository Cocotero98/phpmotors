<?php
    /*PHPMotors vehicles controller
    * This file is accessed at http://lvh.me/phpmotors/vehicles
    * or at http://lvh.me/phpmotors/vehicles/index.php
    *
    * This file controls all traffic to the http://lvh.me/phpmotors/vehicles/URL
    */

// Get the database connection file 
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = createNav($classifications);

//


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
            $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            if (empty($classificationName)){
                $message = '<p>Please, provide the required information</p>';
                include '../view/add-classification.php';
                exit;
            }
            $insertOutcome = addClassification($classificationName);
            if ($insertOutcome === 1){
                $message = "<p>$classificationName successfully added.</p>";
                header('Location: /phpmotors/vehicles');//include '../view/vehicle-management.php';
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
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId'));
            
            $invPrice = checkFloat($invPrice);
            $invStock = checkInt($invStock);
            
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
                $message = '<p>Please, provide the required information</p>';
                include '../view/add-vehicle.php';
                exit;
            }
            $insrtVclOut = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
            if ($insrtVclOut === 1){
                $message = "<p>$invMake $invModel successfully added.</p>";
                header('Location: /phpmotors/vehicles');//include '../view/vehicle-management.php';
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
