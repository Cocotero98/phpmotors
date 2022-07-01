<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title>Image Management | PHP Motors</title>
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
        <main id='uploads'>
            <h1>Image Management</h1>
            <p>Welcome to the Image Management page. Please, choose one of the options presented below. </p>
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
            echo $message;
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label for="invId">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <label>Upload Image:</label>
            <input type="file" name="file1">
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            } ?>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>