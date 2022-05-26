<!DOCTYPE HTML>
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
            <label for="classification">
                <?php echo $classificationList; ?>
            </label>
            <label for="invMake">Make:
                <input type="text" id="invMake" name="invMake">
            </label>
            <label for="invModel">Model:
                <input type="text" id="invModel" name="invModel">
            </label>
            <label for="invDescription">Description:
                <input type="text" id="invDescription" name="invDescription">
            </label>
            <label for="invImage">Image path:
                <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png">
            </label>
            <label for="invThumbnail">Thumbnail path:
                <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png">
            </label>
            <label for="invPrice">Price:
                <input type="text" id="invPrice" name="invPrice">
            </label>
            <label for="invStock">Stock:
                <input type="text" id="invStock" name="invStock">
            </label>
            <label for="invColor">Color:
                <input type="text" id="invColor" name="invColor">
            </label>
            <button type="submit" id="addClasificationName">Add</button>
            <input type="hidden" name="action" value="addVehicle">
            </form>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>