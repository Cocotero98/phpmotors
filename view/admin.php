<?php
if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/');
   }
?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title>Admin | PHP Motors</title>
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
        <main id="admin-main">
            <h1>Logged in <?php $_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname'] ?></h1>
            <ul>
                <li>First name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
                <li>Last name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
                <li>Email address: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
                <li>Level: <?php echo $_SESSION['clientData']['clientLevel'] ?></li>
            </ul>
            <?php if($_SESSION['clientData']['clientLevel'] > 1){
                echo '<p><a href="/phpmotors/vehicles/">Vehicle Management</a></p>';
            } ?>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>