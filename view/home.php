<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta name="description" content="Agustin Aguilar's PHP Motors website project">        
        <title>Home | PHP Motors</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href="css/base.css" rel="stylesheet"  type = "text/css">
        <link href="css/medium.css" rel="stylesheet" type="text/css">
        <link href="css/large.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>
            <nav><?php echo $navList; ?></nav>
        </header>
        <main>
            <h1 id="home-h1">Welcome to PHP Motors!</h1>
            <h2 id="small-title">Welcome to PHP Motors!</h2>
        <div class="delorean">
            <div class="delorean-description">
                <h3>DMC Delorean</h3>
                <p>3 Cup holders<br>Superman doors<br>Fuzzy dice!</p>
            </div>
            <img src="images/vehicles/delorean.jpg" alt="Delorean car">
            <a href="/phpmotors/vehicles/?action=details&invId=28">Own Today</a>
        </div>
        <div class="delorean-reviews">
            <h2>DMC Delorean Reviews</h2>
            <ul>
                <li>"So fast its almost like traveling in time." (4/5)</li>
                <li>"Coolest ride on the road." (4/5)</li>
                <li>"I'm feeling Marty McFly!" (5/5)</li>
                <li>"The most futuristic ride of our day" (4.5/5)</li>
                <li>"80's living and I love it" (5/5)</li>
            </ul>
        </div>
        <div class="delorean-upgrades">
            <h2>Delorean Upgrades</h2>
            <div id="flux">
                <a href="">
                <div>
                    <img src="images/upgrades/flux-cap.png" alt="Flux capacitor">
                </div>
                Flux Capacitor</a>
            </div>
            <div id="flame">
                <a href="">
                <div>
                    <img src="images/upgrades/flame.jpg" alt="Flame Decal">
                </div>
                Flame Decals</a>
            </div>
            <div id="bumper">
                <a href="">
                <div>
                    <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers"> 
                </div>
                Bumper Stickers</a>
            </div>            
            <div id="hub">
                <a href="">
                <div>
                    <img src="images/upgrades/hub-cap.jpg" alt="Hub Cap">
                </div>
                Hub Caps</a>
            </div>
        </div>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    </body>
</html>