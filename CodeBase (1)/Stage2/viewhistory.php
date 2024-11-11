<?php 
session_start();
$account_username = $_SESSION['username'];

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

elseif (isset($_POST['view_currencies'])){
    
    header("Location: view_currencies");
    exit();}


elseif (isset($_POST['convert_currencies'])){
    
    header("Location: convert_currencies.php");
    exit();}




    
$db = new SQLite3("Stage2.db");
$sql = "SELECT User_ID FROM User_Accounts WHERE Account_Name = '$account_username'";
$result = $db->query($sql);
$user_id_data = $result->fetchArray(SQLITE3_ASSOC);
$user_id = $user_id_data['User_ID'];
$sql2 = "SELECT * FROM User_History WHERE User_ID = '$user_id' ORDER BY Date_Viewed DESC";

$result2 = $db->query($sql2);


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">View History</div>
    <div class="background-box">
        <form method="post">
            <input type="submit" class="submitbutton" value="Home" name="Home">
            <input type="submit" class="submitbutton" value="Search Currency Name" name="searchcurrency">
            <input type="submit" class="submitbutton" value="View History" name="viewhistory">
            <input type="submit" class="submitbutton" value="Convert Currency Tool" name="convert_currencies">
        </form>
        <table class='table'>    
            <thead class='History'>
                <tr>
                    <th>Currency Viewed</th>
                    <th>Date Viewed</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Currency_Name'] . "</td>";
                echo "<td>" . $row['Date_Viewed'] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php require("Footer.php");?>