<?php
session_start();

$db = new SQLite3("Stage2.db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM User_Accounts WHERE Account_Name='$username' AND Passwords='$password'";
    $result = $db->query($query);

    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
       
        $_SESSION['username'] = $username;

        
        if ($row['Is_Admin'] == 1) {
            header("Location: AdminHomePage.php"); 
        } else {
            header("Location: UserHomePage.php"); 
        }
    } else {
       
        echo "Invalid username or password";
    }
}

?>




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>
<body class="Login">
    <div class="titletext">Log In Page</div>
    <form method="POST" action="login.php">
        <div class='Form'>        
            <input type="text" placeholder="Enter Username" name="username" required>      
            <input type="password" placeholder="Enter Password" name="password" required>        
            <button class="submit" type="submit">Login</button>  
            <a href="CreateAccount.php" class="create-account">Create Account</a>       
                   
        </div>
    </form>
    
</body>
</html>

