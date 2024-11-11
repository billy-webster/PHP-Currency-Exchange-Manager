<?php
$message = "";
session_start();
$account_username = $_SESSION['username'];
$db = new SQLite3("Stage2.db");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteduser = $_POST["delete"];
    $sqlstatement2 = "SELECT Account_Name FROM User_Accounts WHERE Account_Name = '$deleteduser'";
    $result2 = $db->query($sqlstatement2);
    $tabledata2 = $result2->fetchArray(SQLITE3_ASSOC);
    if ($tabledata2) {
        
        $sqlstatement = "DELETE FROM User_Accounts WHERE Account_Name = '$deleteduser';";
        $deleteresult = $db->exec($sqlstatement);
        if ($deleteresult) {
            $message = "$deleteduser removed from system.";
        } else {
            $message = "Error removing '$deleteduser'.";
        }
    } else {
        
        $message = "No user exists with the username '$deleteduser'.";
    }
}
$db->close(); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">Delete Accounts</div>
    <form method="post">
        <input type="text" class="input" name="delete" placeholder="Enter Username of Account you wish to Delete.">
        <input type="submit" class="submitbutton" value="Submit">
    </form>
    <p><?php echo $message; ?></p>
    <a href="AdminHomePage.php" style="width: 200px; margin: 0 auto; padding: 10px 30px; text-align: center; font-size: 18px; font-weight: bold; border: none; background-color: #a9d6ff; color: black; border-radius: 15px; text-decoration: none; display: block; position: relative; top: 100px;">Home</a>

</body>
</html>

<?php require("AdminFooter.php");?>
