<?php 
session_start();

if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    exit(); 
}


if (isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();

}

elseif (isset($_POST['account_manager'])){
    
    header("Location: account_manager.php");
    exit();}

elseif (isset($_POST['view_currencies'])){
    
    header("Location: viewcurrencies.php");
    exit();}


elseif (isset($_POST['convert_currencies'])){
    
    header("Location: convert_currencies.php");
    exit();}





?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">Currency Home Page</div>
    <div class="background-box">
    <form method="post">
    <input type="submit" class="submitbutton" value="Log Out" name="logout">
            <input type="submit" class="submitbutton" value="Account Manager" name="account_manager">
            <input type="submit" class="submitbutton" value="View Currencies" name="view_currencies">
            <input type="submit" class="submitbutton" value="Convert Currencies" name="convert_currencies">
    </form>
</div>
    
</body>
</html>

<?php require("Footer.php");?>