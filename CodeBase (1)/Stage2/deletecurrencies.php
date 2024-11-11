<?php
$message = "";
session_start();
$account_username = $_SESSION['username'];
$db = new SQLite3("Stage2.db");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deletedcurrency = $_POST["delete"];
    $sqlstatement2 = "SELECT Currency_ID FROM Currencies WHERE Currency_Name = '$deletedcurrency'";
    $result2 = $db->query($sqlstatement2);
    $tabledata2 = $result2->fetchArray(SQLITE3_ASSOC);
    $currency_id = $tabledata2['Currency_ID'];

    if ($tabledata2) {
        
        $sqlstatement = "DELETE FROM Currencies WHERE Currency_Name = '$deletedcurrency';";
        $deleteresult = $db->exec($sqlstatement);
        $sqlstatement2 = "DELETE FROM Currency_Information WHERE Currency_ID = '$currency_id';";
        $deleteresult2 = $db->exec($sqlstatement2);
        
        if ($deleteresult && $deleteresult2) {
            $message = "$deletedcurrency removed from system.";
        } else {
            $message = "Error removing '$deletedcurrency'.";
        }
    } else {
        
        $message = "No currency exists with the name '$deletedcurrency'.";
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
    <div class="titletext">Delete Currency</div>
    <form method="post">
        <input type="text" class="input" name="delete" placeholder="Enter Name of Currency you wish to Delete.">
        <input type="submit" class="submitbutton" value="Submit">
    </form>
    <p><?php echo $message; ?></p>
    <a href="AdminHomePage.php" style="width: 200px; margin: 0 auto; padding: 10px 30px; text-align: center; font-size: 18px; font-weight: bold; border: none; background-color: #a9d6ff; color: black; border-radius: 15px; text-decoration: none; display: block; position: relative; top: 100px;">Home</a>

</body>
</html>

<?php require("AdminFooter.php");?>
