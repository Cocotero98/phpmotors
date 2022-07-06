<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project"> 
        <title><?php if(isset($detailsDisplay)){
            $detail = $details[0];
            echo "$detail[invMake] $detail[invModel]";
        } ?> | PHP Motors</title>
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
        <main id='car-details'>
        <?php if(isset($message)){
                echo $message;
            } ?>
            <div id='large-view-tn'>
            <?php if(isset($tnDisplay)){
                echo $tnDisplay;
            } ?></div>
            <?php if(isset($detailsDisplay)){
                echo $detailsDisplay;
            } ?>
            <div id='small-view-tn'>
            <h3>Vehicle Thumbnails</h3>
            <?php if(isset($tnDisplay)){
                echo $tnDisplay;
            } ?></div>
            <div class='reviews'>
            <h3>Customer reviews</h3>
            <?php if(isset($_SESSION['loggedin'])){
                if(isset($reviewForm)){
                    echo "<h3>Review the $detail[invMake] $detail[invModel]</h3>";
                    if(isset($_SESSION['message'])){
                        echo $_SESSION['message'];
                    };
                    echo $reviewForm;
                }
            }else{
                echo '<p>You most <a href="/phpmotors/accounts/index.php?action=login">loggin</a> to add a review.</p>';
            } 
            if(isset($reviewsSection)){
                echo $reviewsSection;
            }
            ?>
            </div>
        </main>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>