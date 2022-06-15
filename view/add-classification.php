<?php
// Check if client has access to this view
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/');
}
?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title>Add Classification | PHP Motors</title>
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
            <h1>Add a new classification</h1>
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="classificationName">Classification Name (No more than 30 characters):
                <input type="text" id="classificationName" name="classificationName" maxlength="30" required>
            </label>
            <button type="submit" id="addClasificationName">Add</button>
            <input type="hidden" name="action" value="addClassification">
            </form>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>