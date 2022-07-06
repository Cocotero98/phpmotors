<?php
/* Reviews controller */

// Create or access Session
session_start();
// Require for necessary files
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

// Get the array of classifications and build a navigation bar
$classifications = getClassifications();
$navList = createNav($classifications);

//Add review form


//Obtain action value for the switch case
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    
    switch ($action){
        case 'addNew':
            $clientId = $_SESSION['clientData']['clientId'];
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            //Check if variables are empty 
            if(empty($reviewText)|$invId!='asdf'){
                $_SESSION['message'] = '<p>Please, write a review before submitting</p>'.$invId;
                include '../view/vehicle-detail.php';
                exit;
            }
            $reviewAdded = insertReview($clientId, $invId, $reviewText);
            if($reviewAdded){
                $_SESSION['message'] = '<p>Review successfully added.</p>';
                include '../view/vehicle-detail.php';
                exit;
            }


            break;
        case 'editReview':
            break;
        case 'reviewEdited':
            break;
        case 'confirmDel':
            break;
        case 'reviewDeleted':
            break;
        default:
            break;

    }