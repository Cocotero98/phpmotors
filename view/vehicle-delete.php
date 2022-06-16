<?php
// Check if client has access to this view
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/');
    exit;
}

?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?></h1>
        <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="invMake">Make:
                <input type="text" readonly id="invMake" name="invMake" <?php
                    if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
            </label>
            <label for="invModel">Model:
                <input type="text" readonly id="invModel" name="invModel" <?php 
                    if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
            </label>
            <label for="invDescription">Description:
                <input type="text" id="invDescription" name="invDescription" <?php 
                    if(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; } ?>>
            </label>
            <button type="submit" id="addClasificationName">Delete Vehicle</button>
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
                echo $invInfo['invId'];} ?>">
            </form>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>