<?php
$db = new SQLite3("Stage2.db");
$message = "";
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
        $updatetable = "UPDATE User_Accounts SET User_ID = '$userId', First_Name = '$firstname', Last_Name = '$lastname', Email = '$email', Passwords = '$password', Is_Admin = '$admin' WHERE User_ID = '$userId';";
        $updateresult = $db->exec($updatetable);
        if ($updateresult){
            $message = "$username's Details Updated.";
        }
        else {
            $message = "Error updating $username";
        }
    } else {
        $message = "No Account exists with the username $username";
        
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
    <div class="titletext">Edit Account</div>
    <div class='Form'>    
        <form method="post" action="">    
            <input type="text" placeholder="Enter User ID" name="userId" required>      
            <input type="text" placeholder="Enter Username" name="username" required>      
            <input type="text" placeholder="Enter Password" name="password" required>  
            <input type="text" placeholder="Enter First Name" name="firstname" required>    
            <input type="text" placeholder="Enter Last Name" name="lastname" required>    
            <input type="email" placeholder="Enter Email" name="email" required>  
            <input type="text" placeholder="Enter 1 or 0 For Account Type" name="admin" required>
            <button class="submit" type="submit">Edit Account</button>
            <p><?php echo $message; ?></p>
        </form>
        
        <a href="AdminHomePage.php" class="Login">Home</a>
        
    </div>
</body>
</html>
