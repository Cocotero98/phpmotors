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
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            //Check if variables are empty 
            if(empty($reviewText) ){
                $_SESSION['message'] = '<p>Please, write a review before submitting</p>';
                header('Location: /phpmotors/vehicles/index.php?action=details&invId='.$invId);
                exit;
            }
            $reviewAdded = insertReview($clientId, $invId, $reviewText);
            if($reviewAdded){
                $_SESSION['message'] = '<p>Review successfully added.</p>';
                header('Location: /phpmotors/vehicles/index.php?action=details&invId='.$invId);
                exit;
            }else{
                $_SESSION['message'] = '<p>Sorry, something went wrong. Review not added. Please try again.</p>';
                header('Location: /phpmotors/vehicles/index.php?action=details&invId='.$invId);
                exit;
            }
            break;
        case 'editReview':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $review = getReview($reviewId);
            if(!count($review)){
                $message = '<p>Sorry, review not found.</p>';
                include '/phpmotors/accounts/';
                exit;
            }
            $editableReview = editReviewForm($review);
            include '../view/update-review.php';
            break;
        case 'confirmedEdit':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            if(empty($reviewText)){
                $_SESSION['message'] = 'The review field was empty, so the review was not updated.';
                header('Location: /phpmotors/reviews/index.php?action=editReview&reviewId='.$reviewId.'');
                exit;
            }
            $result = updateReview($reviewId, $reviewText);
            if($result){
                $_SESSION['message'] = 'Review successfully updated.';
                header('Location: /phpmotors/accounts/');
            }else{
                $_SESSION['message'] = 'An error occured. Review not updated. Please, try again.';
                header('Location: /phpmotors/reviews/index.php?action=editReview&reviewId='.$reviewId.'');
            }
            break;
        case 'confirmDel':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $review = getReview($reviewId);
            if(!count($review)){
                $message = '<p>Sorry, review not found.</p>';
                include '/phpmotors/accounts/';
                exit;
            }
            $reviewToDelete = deleteReviewForm($review);
            include '../view/update-review.php';
            break;
            break;
        case 'reviewDeleted':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $reviewDeleted = deleteReview($reviewId);
            if($reviewDeleted){
                $_SESSION['message'] = 'Review successfully deleted';
                header('Location: /phpmotors/accounts/');
            }
            else{
                $_SESSION['message'] = 'There was an error and the review could not be deleted. Please, try again later.';
                header('Location: /phpmotors/reviews/index.php?action=confirmDel&reviewId='.$reviewId.'');
            }
            break;
        default:
            
            break;

    }