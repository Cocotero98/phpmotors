<?php
//Vehicles PHPMotors model
function addClassification($classificationName){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO carclassification (classificationName)
    VALUES (:classificationName)';
    // The next line creates the prepared statement using the phpmotors connection. It uses the "prepare" method from the connection object    
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // The next line runs the prepared statement we created in last line
    $stmt->execute(); 
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    //return rows added
    return $rowsChanged;
}
function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
    VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // The next line creates the prepared statement using the phpmotors connection. It uses the "prepare" method from the connection object    
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    // The next line runs the prepared statement we created in last line
    $stmt->execute(); 
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    //return rows added
    return $rowsChanged;
}