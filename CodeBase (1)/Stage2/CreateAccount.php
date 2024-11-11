<?php
$db = new SQLite3("Stage2.db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

   
    $sqlstatement = "SELECT MAX(User_ID) AS max FROM User_Accounts";
    $result = $db->query($sqlstatement);
    $tabledata = $result->fetchArray(SQLITE3_ASSOC);

    $Is_admin = 0;
    $NextId = $tabledata['max'] + 1;

    
    $sqlstatement2 = "SELECT Account_Name FROM User_Accounts WHERE Account_Name = '$username'";
    $result2 = $db->query($sqlstatement2);
    $tabledata2 = $result2->fetchArray(SQLITE3_ASSOC);

    if ($tabledata2) {
        echo "Username already exists. Please choose a different username.";
    } else {
        
        $sqlInsert = "INSERT INTO User_Accounts (User_ID, Account_Name, Passwords, First_Name, Last_Name, Email, Is_Admin) VALUES ($NextId, '$username', '$password', '$firstname', '$lastname', '$email', $Is_admin)";
        $insertResult = $db->query($sqlInsert);
        $db->close();
        

        if ($insertResult) {
            echo "User account created successfully.";
        } else {
            echo "Error creating user account.";
        }
    }
    

    
}



?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CreateAccount.css">
    </head>
    <body>
        <div class="titletext">Create Account</div>
        <div class='Form'>    
        <form method="post" action="">    
            <input type="text" placeholder="Enter Username" name="username" required>      
            <input type="password" placeholder="Enter Password" name="password" required>  
            <input type="text" placeholder="Enter First Name" name="firstname" required>    
            <input type="text" placeholder="Enter Last Name" name="lastname" required>    
            <input type="email" placeholder="Enter Email" name="email" required>  
            <button class="submit" type="submit">Create Account</button>
            </form>
            <a href="Login.php" class="Login">Login</a>
        </div>
</body>


<?php require("Footer.php");?>