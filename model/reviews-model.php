<?php
//This model is to handle the reviews

//Add a review to the database
function insertReview($clientId, $invId, $reviewText){
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, clientId, invId) VALUES (:reviewText, :clientId, :invId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Get reviews for a specific inventory item 
function getReviews($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews JOIN clients ON clients.clientId = reviews.clientId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

//Get reviews written by a specific client 
function getClientReviews($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews JOIN inventory on reviews.invId = inventory.invId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

//Get a specific review 
function getReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews JOIN inventory on reviews.invId = inventory.invId WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}

//Update a specific review
function updateReview($reviewId, $reviewText){
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviews.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Delete a specific review 
function deleteReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM `reviews` WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}