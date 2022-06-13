<?php
$classificationList = "<select id='classification' name='classificationId'>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value=$classification[classificationId]";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
            $classificationList .=' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= "</select>";

?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title>Add Vehicle | PHP Motors</title>
        <link href="/phpmotors/css/base.css" rel="stylesheet"  type = "text/css">
        <link href="/phpmotors/css/medium.css" rel="stylesheet"  type = "text/css">
        <link href="/phpmotors/css/large.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>
            <nav><?php echo $navList; ?></nav>
        </header>
        <main class="classification-main">
            <h1>Add a new vehicle</h1>
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="classification"> Choose Car Classification:
                <?php echo $classificationList; ?>
            </label>
            <label for="invMake">Make:
                <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required>
            </label>
            <label for="invModel">Model:
                <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required>
            </label>
            <label for="invDescription">Description:
                <input type="text" id="invDescription" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required>
            </label>
            <label for="invImage">Image path:
                <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required>
            </label>
            <label for="invThumbnail">Thumbnail path:
                <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>
            </label>
            <label for="invPrice">Price:
                <input type="number" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required >
            </label>
            <label for="invStock">Stock:
                <input type="number" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
            </label>
            <label for="invColor">Color:
                <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
            </label>
            <button type="submit" id="addClasificationName">Add</button>
            <input type="hidden" name="action" value="addVehicle">
            </form>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>