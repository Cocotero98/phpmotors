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
    $dv .= "<a href='/phpmotors/vehicles/?action=details&invId=$vehicle[invId]'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
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
  

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
 $i = strrpos($image, '.');
 $image_name = substr($image, 0, $i);
 $ext = substr($image, $i);
 $image = $image_name . '-tn' . $ext;
 return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
   $id = '<ul id="image-display">';
   foreach ($imageArray as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
    $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</li>';
  }
   $id .= '</ul>';
   return $id;
  }

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
   $prodList = '<select name="invId" id="invId">';
   $prodList .= "<option>Choose a Vehicle</option>";
   foreach ($vehicles as $vehicle) {
    $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
   }
   $prodList .= '</select>';
   return $prodList;
  }

  // Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
   // Gets the paths, full and local directory
   global $image_dir, $image_dir_path;
   if (isset($_FILES[$name])) {
    // Gets the actual file name
    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
     return;
    }
   // Get the file from the temp folder on the server
   $source = $_FILES[$name]['tmp_name'];
   // Sets the new path - images folder in this directory
   $target = $image_dir_path . '/' . $filename;
   // Moves the file to the target folder
   move_uploaded_file($source, $target);
   // Send file for further processing
   processImage($image_dir_path, $filename);
   // Sets the path for the image for Database storage
   $filepath = $image_dir . '/' . $filename;
   // Returns the path where the file is stored
   return $filepath;
   }
  }

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
   // Set up the variables
   $dir = $dir . '/';
  
   // Set up the image path
   $image_path = $dir . $filename;
  
   // Set up the thumbnail image path
   $image_path_tn = $dir.makeThumbnailName($filename);
  
   // Create a thumbnail image that's a maximum of 200 pixels square
   resizeImage($image_path, $image_path_tn, 200, 200);
  
   // Resize original to a maximum of 500 pixels square
   resizeImage($image_path, $image_path, 500, 500);
  }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
   // Get image type
   $image_info = getimagesize($old_image_path);
   $image_type = $image_info[2];
  
   // Set up the function names
   switch ($image_type) {
   case IMAGETYPE_JPEG:
    $image_from_file = 'imagecreatefromjpeg';
    $image_to_file = 'imagejpeg';
   break;
   case IMAGETYPE_GIF:
    $image_from_file = 'imagecreatefromgif';
    $image_to_file = 'imagegif';
   break;
   case IMAGETYPE_PNG:
    $image_from_file = 'imagecreatefrompng';
    $image_to_file = 'imagepng';
   break;
   default:
    return;
  } // ends the swith
  
   // Get the old image and its height and width
   $old_image = $image_from_file($old_image_path);
   $old_width = imagesx($old_image);
   $old_height = imagesy($old_image);
  
   // Calculate height and width ratios
   $width_ratio = $old_width / $max_width;
   $height_ratio = $old_height / $max_height;
  
   // If image is larger than specified ratio, create the new image
   if ($width_ratio > 1 || $height_ratio > 1) {
  
    // Calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);
  
    // Create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);
  
    // Set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
     $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
     imagecolortransparent($new_image, $alpha);
    }
  
    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
     imagealphablending($new_image, false);
     imagesavealpha($new_image, true);
    }
  
    // Copy old image to new image - this resizes the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
  
    // Write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // Free any memory associated with the new image
    imagedestroy($new_image);
    } else {
    // Write the old image to a new file
    $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
  } // ends resizeImage function

  // Build Thumbnails display for vehicle details
  function buildTnDisplay($tnImages){
   $thumbnailsDisplay = '<ul>';
   foreach ($tnImages as $image) {
      $thumbnailsDisplay .='<li><img src="'.$image['imgPath'].'" alt="'."$image[invMake] $image[invModel]".' image"></li>';
   }
   $thumbnailsDisplay .= '</ul>';
   return $thumbnailsDisplay;
  }

  //Build review form
  function buildReviewForm($clientFirstname,$clientLastname,$clientId,$invId){
   $initial = substr($clientFirstname,0,1);
   $screenName = $initial . $clientLastname;
   $form = "<form method='post' action='/phpmotors/reviews/index.php'>
               <fieldset>
               <label for='screenName'>Screen name: 
                  <input type='text' readonly value='$screenName' id='screenName'>
               </label>
               <label for='review'>Review:'
                  <textarea id='review' name='reviewText' required></textarea>
               </label>
               <button type='submit' id='addNewReview'>Add Review</button>
               <input type='hidden' name='action' value='addNew'>
               <input type='hidden' name='invId' value='.$invId.'>
               <input type='hidden' name='clientId' value='.$clientId.'>
               </fieldset>
            </form>";
   return $form;
  }
  // This function takes an array of reviews and organizes it by date. Then it takes a callback 
  // function to build the display to show in the view
  function displayReviews($reviews, $callback){
   $reviewsArray = [];
   $oldestDate = 0;
   $counter = $reviews;
   for ($i = 0 ; $i < count($counter); $i++){
   foreach($reviews as $review){
      $reviewDate = strtotime($review['reviewDate']);
      if($reviewDate>$oldestDate){
         $oldestDate = $reviewDate;
      }
   }
   foreach($reviews as $review){
      $reviewDate = strtotime($review['reviewDate']);
      if ($reviewDate===$oldestDate){
         array_push($reviewsArray,$review);
         $index = array_search($review,$reviews);
         unset($reviews[$index]);
         $oldestDate = 0;
      }
   }
   }
   $section = $callback($reviewsArray);
   return $section;
}

//This function displays the client's screen name, the review, and the date 
function nameAndReview($reviewsArray){
   $reviewsSection = '';
   foreach($reviewsArray as $review){
         $reviewDate = date('F j, Y, g:i a',strtotime($review['reviewDate']));
         $initial = substr($review['clientFirstname'],0,1);
         $screenName = $initial . $review['clientLastname'];
         $reviewsSection.='<div><p>'.$screenName.' wrote on '.$reviewDate.':<br><span>'.$review['reviewText'].'</span></p></div>';
         
      }
      return $reviewsSection;
}

//This function displays a list of reviews with links to edit or delete
function editableReview($reviewsArray){
   $reviewsSection = '<h3>Manage your products reviews</h3><ul>';
   foreach($reviewsArray as $review){
      $reviewDate = date('F j, Y, g:i a',strtotime($review['reviewDate']));
      $invName = "$review[invModel] $review[invMake]";
      $reviewsSection.='<li>'.$invName.' (reviewd on '.$reviewDate.'): 
      <a href="/phpmotors/reviews/index.php?action=editReview&reviewId='.$review['reviewId'].'">Edit</a> 
      <a href="/phpmotors/reviews/index.php?action=confirmDel&reviewId='.$review['reviewId'].'">Delete</a>
      </li>';  
   }
   $reviewsSection .= '</ul>';
   return $reviewsSection;
}

//This function displays a form to edit a review.
function editReviewForm($review){
   $review = $review[0];
   $reviewDate = date('F j, Y, g:i a',strtotime($review['reviewDate']));
   $display = "<h2>$review[invMake] $review[invModel] Review</h2>";
   $display .= "<h3>Reviewed on $reviewDate</h3>";
   $display .= "<form method='post' action='/phpmotors/reviews/index.php'>
                  <fieldset>
                     <label for='reviewText'>Review Text
                        <textarea id='reviewText' name='reviewText' required>$review[reviewText]</textarea>
                     </label>
                     <button type='submit' id='updateReview'>Update</button>
                     <input type='hidden' name='action' value='confirmedEdit'>
                     <input type='hidden' name='reviewId' value='".$review['reviewId']."'>
                  </fieldset>
               </form>";
               return $display;
}
function deleteReviewForm($review){
   $review = $review[0];
   $reviewDate = date('F j, Y, g:i a',strtotime($review['reviewDate']));
   $display = "<h2>$review[invModel] $review[invMake] Delete</h2><h3 class='warning'>Warning: This action cannot be undone.</h3>";
   $display .= "<h3>Reviewed on $reviewDate</h3>";
   $display .= "<form method='post' action='/phpmotors/reviews/index.php'>
                  <fieldset>
                     <label for='reviewText'>Review Text
                        <textarea id='reviewText' name='reviewText' readonly>$review[reviewText]</textarea>
                     </label>
                     <button type='submit' id='deleteReview'>Delete</button>
                     <input type='hidden' name='action' value='reviewDeleted'>
                     <input type='hidden' name='reviewId' value='".$review['reviewId']."'>
                  </fieldset>
               </form>";
               return $display;   
}