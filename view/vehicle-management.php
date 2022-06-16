<?php
// Check if client has access to this view
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/');
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title>Management | PHP Motors</title>
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
        <main class="vehicles">
            <h1>Vehicles Management</h1>
            
            <a href="/phpmotors/vehicles/index.php?action=addclassification">Add classification</a>
            <a href="/phpmotors/vehicles/index.php?action=addvehicle">Add vehicle</a>
            <?php
            if (isset($message)) {
            echo $message;
            }
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
               }
            ?>
            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    <script src="../js/inventory.js"></script>
    </body>
</html>
<?php unset($_SESSION['message']); ?>