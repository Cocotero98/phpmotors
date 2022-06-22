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
        <title>Update Account | PHP Motors</title>
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
            <h1>Manage Account</h1>
            <h3>Account update</h3>
            <?php
                if (isset($_SESSION['accountMesagge'])) {
                    echo $_SESSION['accountMesagge'];
                    }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <fieldset>
                    <label for="clientFirstname">First Name *
                        <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}else{echo "value=".$_SESSION['clientData']['clientFirstname'];} ?> required>
                    </label>
                    <label for="clientLastname">Last Name *
                        <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} else{echo "value=".$_SESSION['clientData']['clientLastname'];} ?> required>
                    </label>
                    <label for="clientEmail">Email *
                        <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} else{echo "value=".$_SESSION['clientData']['clientEmail'];} ?> required>
                    </label>
                    <input type="hidden" name="clientId" value= <?php echo $_SESSION['clientData']['clientId'] ?>>
                    <button type="submit" name="submit">Update My Account</button>
                    <input type="hidden" name="action" value="accountUpdate">
                </fieldset>
            </form>
            <h3>Change Password</h3>
            <?php
                if (isset($_SESSION['pwdMesagge'])) {
                    echo $_SESSION['pwdMesagge'];
                    }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <fieldset>
                    <label for="clientPassword">Password *
                    <span>This will change your current password to a new one. Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                        <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                    </label>
                    <input type="hidden" name="clientId" value= <?php echo $_SESSION['clientData']['clientId'] ?>>
                    <button type="submit" name="submit">Change password</button>
                    <input type="hidden" name="action" value="changePassword">
                </fieldset>
            </form>
            <p id='required-mark'>* are required fields</p>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</div>
    </body>
</html>