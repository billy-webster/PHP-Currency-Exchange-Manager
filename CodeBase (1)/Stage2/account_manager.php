<?php 

session_start();
$account_username = $_SESSION['username'];

$db = new SQLite3("Stage2.db");


$sql = "SELECT User_ID,First_Name, Last_Name, Email, Passwords FROM User_Accounts WHERE Account_Name = '$account_username'";
$result = $db->query($sql);
$data =  $result->fetchArray(SQLITE3_ASSOC);
$first_name = $data['First_Name'];
$last_name = $data['Last_Name'];
$email = $data['Email'];
$password = $data['Passwords'];
$userid = $data['User_ID'];

if (isset($_POST['fnamebutton'])){
    $fnameset = $_POST["fname"];
    $fnamesql = "UPDATE User_Accounts SET First_Name = '$fnameset' WHERE Account_Name = '$account_username'";
    $db->exec($fnamesql);
    echo "First Name Changed";
    $db->close(); 
}


if (isset($_POST['lnamebutton'])){
    $lnameset = $_POST["lname"];
    $lnamesql = "UPDATE User_Accounts SET Last_Name = '$lnameset' WHERE Account_Name = '$account_username'";
    $db->exec($lnamesql);
    echo "Last Name Changed";
    $db->close(); 
}
if (isset($_POST['passwordbutton'])){
    $passwordset = $_POST["password"];
    $passwordsql = "UPDATE User_Accounts SET Passwords = '$passwordset' WHERE Account_Name = '$account_username'";
    $db->exec($passwordsql);
    echo "Password Changed";
    $db->close(); 
}
if (isset($_POST['emailbutton'])){
    $Emailset = $_POST["email"];
    $Emailsql = "UPDATE User_Accounts SET Email = '$Emailset' WHERE Account_Name = '$account_username'";
    $db->exec($Emailsql);
    echo "Email Changed";
    $db->close(); 
}

if (isset($_POST['currencybutton'])){
    $currencyset = $_POST["prefcurrency"];
    $currencysql = "INSERT INTO Preffered_Currency (User_ID,Currency_ID) VALUES ('$userid','$currencyset')";
    $db->exec($currencyysql);
    echo "Currency Set";
    $db->close();

    
     
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="account_manager.css">
    <title>Account Manager</title>
</head>
<body class="Login">
    <div class="titletext">Manage Your Account</div>
      
       <form method="POST" action="account_manager.php">
        <div class='Form'>        
            <div>First Name: <?php echo $first_name?></div>
            <input type="text" placeholder="Enter First Name" name="fname" required>  
            <button class="submit" type="submit" name="fnamebutton">Change</button>    
        </div>
    </form>

    
    <form method="POST" action="account_manager.php">
        <div class='Form'>        
            <div>Last Name: <?php echo $last_name?></div>
            <input type="text" placeholder="Enter Last Name" name="lname" required>  
            <button class="submit" type="submit" name="lnamebutton">Change</button>
        </div>
    </form>

    
    <form method="POST" action="account_manager.php">
        <div class='Form'>        
            <div>Password: <?php echo $password?></div>
            <input type="password" placeholder="Enter Password" name="password" required>        
            <button class="submit" type="submit" name="passwordbutton">Change</button> 
        </div>
    </form>

    
    <form method="POST" action="account_manager.php">
        <div class='Form'>        
            <div>Email Address: <?php echo $email?></div>
            <input type="text" placeholder="Enter Email" name="email" required>  
            <button class="submit" type="submit" name="emailbutton">Change</button> 
        </div>
    </form>

    
    <form method="POST" action="account_manager.php">
        <div class='Form'>        
            <div>Select Currency:</div>
            <input type="text" placeholder="Enter Preferred Currency ID Found in Currency Information" name="prefcurrency" required>  
            <button class="submit" type="submit" name="currencybutton">Change</button>   
            <a href="UserHomePage.php" class="HomeButton">Home</a>    
        </div>
    </form>
    
       
</body>
</html>

    
</body>
</html>

<?php require("Footer.php");?>