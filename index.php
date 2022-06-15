<?php
    /*PHPMotors main controller
    * This file is accessed at http://lvh.me/phpmotors/
    * or at http://lvh.me/phpmotors/index.php
    *
    * This file controls all traffic to the http://lvh.me/phpmotors/URL
    */
// Create or access a Session
session_start();
// Get the database connection file 
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// echo "<pre>";
// var_dump($classifications);
// echo "</pre>";
// exit;

// Build a navigation bar using the $classifications array
// $navList = '<ul>';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';
$navList = createNav($classifications);
// echo $navList;
// exit;
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action){
        case 'template':
            include 'view/template.php';
            break;
        case 'vehicle':
            include 'view/vehicle-management.php';
            break;
        default:
            include 'view/home.php';
    }
