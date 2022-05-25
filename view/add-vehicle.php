<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title>Template | PHP Motors</title>
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
            <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="classification">
                <?php echo $classificationList; ?>
            </label>
            <label for="invMake">Make:
                <input type="text" id="invMake" name="invMake"></input>
            </label>
            <label for="invModel">Model:
                <input type="text" id="invModel" name="invModel"></input>
            </label>
            <label for="invDescription">Description:
                <input type="text" id="invDescription" name="invDescription"></input>
            </label>
            <label for="invImage">Image path:
                <input type="text" id="invImage" name="invImage"></input>
            </label>
            <label for="invThumbnail">Thumbnail path:
                <input type="text" id="invThumbnail" name="invThumbnail"></input>
            </label>
            <label for="invPrice">Price:
                <input type="text" id="invPrice" name="invPrice"></input>
            </label>
            <label for="invStock">Stock:
                <input type="text" id="invStock" name="invStock"></input>
            </label>
            <label for="invColor">Color:
                <input type="text" id="invColor" name="invColor"></input>
            </label>
            <button type="submit" id="addClasificationName">Add</button>
            </form>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>