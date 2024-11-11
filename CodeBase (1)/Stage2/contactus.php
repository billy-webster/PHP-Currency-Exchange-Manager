<?php
$message = "";
session_start();
$account_username = $_SESSION['username'];
$db = new SQLite3("Stage2.db");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailinput = $_POST["message"];
    $sqlstatement = "SELECT MAX(Message_ID) AS max FROM Customer_Support";

    
    $result = $db->query($sqlstatement);
    $tabledata = $result->fetchArray(SQLITE3_ASSOC);
    $NextId = $tabledata['max'] + 1;
    $date = date('d-m-y h:i:s');
    $sql = "SELECT User_ID FROM User_Accounts WHERE Account_Name = '$account_username'";
    $result = $db->query($sql);
    $user_id_data = $result->fetchArray(SQLITE3_ASSOC);
    $user_id = $user_id_data['User_ID'];
    
    $finalprocess = "INSERT INTO Customer_Support (Message_ID, User_ID, DateOfMessage, Details) VALUES ('$NextId','$user_id','$date','$emailinput')";
    $db->exec($finalprocess);

    $message = "Message has been sent to Customer Support Team";


    
        

}
    
$db->close(); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">Contact Us</div>
    <form method="post">
        <input type="text" class="input" name="message" placeholder="Enter your message here, please attach username at start of email.">
        <input type="submit" class="submitbutton" value="Submit">
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>

<?php require("HomeFooter.php");?>