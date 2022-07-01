<?php
    /*PHPMotors vehicles controller
    * This file is accessed at http://lvh.me/phpmotors/vehicles
    * or at http://lvh.me/phpmotors/vehicles/index.php
    *
    * This file controls all traffic to the http://lvh.me/phpmotors/vehicles/URL
    */

// Create or access a Session
session_start();

// Get the database connection file 
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the uploads model
require_once '../model/uploads-model.php';

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
        /* * ********************************** 
        * Get vehicles by classificationId 
        * Used for starting Update & Delete process 
        * ********************************** */ 
        case 'getInventoryItems': 
            // Get the classificationId to use in the next function
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the vehicles by classificationId from the DB 
            $inventoryArray = getInventoryByClassification($classificationId); 
            // Convert the array to a JSON object and send it back 
            echo json_encode($inventoryArray); 
            break;
        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo)<1){
                $message = 'Sorry, no vehicle information could be found.';
               }
            include '../view/vehicle-update.php';
            exit;
            break;
        case 'updateVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId'));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            $invPrice = checkFloat($invPrice);
            $invStock = checkInt($invStock);
            
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
                $message = '<p>Please, provide the required information</p>';
                include '../view/vehicle-update.php';
                exit;
            }
            $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
            if ($updateResult){
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }else{
                $message = "<p>An error occured and $invMake $invModel was not updated. Please, try again.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
            
            break;
        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
                    $message = 'Sorry, no vehicle information could be found.';
                }
            include '../view/vehicle-delete.php';
            exit;
            break;
        case 'deleteVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            $deleteResult = deleteItem($invId);
            if ($deleteResult){
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }else{
                $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
            break;
        case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)){
                $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
            } else {
                $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            include '../view/classification.php';
            break;
        case 'details':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $details = getVehicleDetails($invId);
            $tnImages = getThumbnails($invId);
            if(!count($details)){
                $message = '<p>Sorry, vehicle not found.</p>';
            }
            $detailsDisplay = buildDetailsDisplay($details);
            $tnDisplay = buildTnDisplay($tnImages);
            include '../view/vehicle-detail.php';
            break;
        default:
            $classificationList = buildClassificationList($classifications);



            include '../view/vehicle-management.php';
            break;
    }
