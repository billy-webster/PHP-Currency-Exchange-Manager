<?php 
session_start();

if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    exit(); 
}


if (isset($_POST['Home'])){
    
    header("Location: UserHomePage.php");
    exit();

}

elseif (isset($_POST['searchcurrency'])){
    
    header("Location: searchcurrency.php");
    exit();}

elseif (isset($_POST['viewhistory'])){
    
    header("Location: viewhistory.php");
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
    <div class="titletext">View Currencies</div>
    <div class="background-box">
    <form method="post">
    <input type="submit" class="submitbutton" value="Home" name="Home">
            <input type="submit" class="submitbutton" value="Search Currency Name" name="searchcurrency">
            <input type="submit" class="submitbutton" value="View History" name="viewhistory">
            <input type="submit" class="submitbutton" value="Convert Currency Tool" name="convert_currencies">
    </form>
</div>
    
</body>
</html>

<?php require("Footer.php");?>