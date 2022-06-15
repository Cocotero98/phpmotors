<img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
<?php if(isset($_SESSION['welcomeMessage'])){
    if(isset($_SESSION['loggedin'])){
 echo "<a href='/phpmotors/accounts/' id='welcomeMessage'>".$_SESSION['welcomeMessage']."</a>";
}} 
if(isset($_SESSION['loggedin'])){
    echo '<a href="/phpmotors/accounts/index.php?action=logout">Logout</a>';
}else{
    echo '<a href="/phpmotors/accounts/index.php?action=login">My Account</a>';
}

?>            
<!-- <a href="/phpmotors/accounts/index.php?action=login">My Account</a> -->
