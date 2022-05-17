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
        <main class="registration">
            <h1>Register</h1>
            <h2>Complete the following form</h2>
            <form>
                <fieldset>
                    <label for="clientFirstname">First Name *
                        <input type="text" name="clientFirstname" id="clientFirstname" required>
                    </label>
                    <label for="clientLastname">Last Name *
                        <input type="text" name="clientLastname" id="clientLastname" required>
                    </label>
                    <label for="clientEmail">Email *
                        <input type="email" name="clientEmail" id="clientEmail" required>
                    </label>
                    <label for="clientPassword">Password *
                        <input type="password" name="clientPassword" id="clientPassword" required>
                    </label>
                    <button type="submit">Sign-up</button>
                </fieldset>
            </form>
            <p id='required-mark'>* are required fields</p>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>