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

elseif (isset($_POST['createaccount'])){
    
    header("Location: createaccounts.php");
    exit();}

elseif (isset($_POST['createcurrency'])){
    
    header("Location: createcurrencies.php");
    exit();}

elseif (isset($_POST['deleteaccount'])){
    
    header("Location: deleteaccounts.php");
    exit();}
    
elseif (isset($_POST['deletecurrency'])){
        
    header("Location: deletecurrencies.php");
    exit();}


elseif (isset($_POST['viewmessages'])){
    
    header("Location: viewmessages.php");
    exit();}

elseif (isset($_POST['editaccount'])){
    
    header("Location: editaccounts.php");
    exit();}
        
elseif (isset($_POST['editcurrency'])){
            
    header("Location: editcurrencies.php");
    exit();}
    







?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">Admin Hub</div>
    <div class="background-box">
    <form method="post">
    <input type="submit" class="submitbutton" value="Log Out" name="logout">
            <input type="submit" class="submitbutton" value="Create New Accounts" name="createaccount">
            <input type="submit" class="submitbutton" value="Edit Existing Accounts" name="editaccount">
            <input type="submit" class="submitbutton" value="Delete Accounts" name="deleteaccount">
            <input type="submit" class="submitbutton" value="Add New Currency" name="createcurrency">
            <input type="submit" class="submitbutton" value="Edit Existing Currency" name="editcurrency">
            <input type="submit" class="submitbutton" value="Delete Currency" name="deletecurrency">
            
    </form>
</div>
    
</body>
</html>

<?php require("adminfooter.php");?>