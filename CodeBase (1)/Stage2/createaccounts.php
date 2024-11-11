<?php
$db = new SQLite3("Stage2.db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

    $sqlstatement2 = "SELECT Account_Name FROM User_Accounts WHERE Account_Name = '$username'";
    $result2 = $db->query($sqlstatement2);
    $tabledata2 = $result2->fetchArray(SQLITE3_ASSOC);

    if ($tabledata2) {
        echo "Username already exists. Please choose a different username.";
    } else {
        $sqlInsert = "INSERT INTO User_Accounts (User_ID, Account_Name, Passwords, First_Name, Last_Name, Email, Is_Admin) VALUES ($userId, '$username', '$password', '$firstname', '$lastname', '$email', $admin)";
        $insertResult = $db->query($sqlInsert);

        if ($insertResult) {
            echo "User account created successfully.";
        } else {
            echo "Error creating user account.";
        }
    }
} 
$db->close();
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
            <input type="text" placeholder="Enter User ID" name="userId" required>      
            <input type="text" placeholder="Enter Username" name="username" required>      
            <input type="text" placeholder="Enter Password" name="password" required>  
            <input type="text" placeholder="Enter First Name" name="firstname" required>    
            <input type="text" placeholder="Enter Last Name" name="lastname" required>    
            <input type="email" placeholder="Enter Email" name="email" required>  
            <input type="text" placeholder="Enter 1 or 0 For Account Type" name="admin" required>
            <button class="submit" type="submit">Create Account</button>
        </form>
        <a href="AdminHomePage.php" class="Login">Home</a>
        
    </div>
</body>
</html>
