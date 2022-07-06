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
        <main>
            <?php 
                if(isset($editableReview)){
                    echo $editableReview;
                }
            ?>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>