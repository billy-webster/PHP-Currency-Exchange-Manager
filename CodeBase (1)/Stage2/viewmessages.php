<?php 
session_start();
$account_username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); 
}

if (isset($_POST['Home'])){
    header("Location: AdminHomePage.php");
    exit();
}

$db = new SQLite3("Stage2.db");
$sql = "SELECT * FROM Customer_Support ";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">View Messages</div>
    <div class="background-box">
        <form method="post">
            <input type="submit" class="submitbutton" value="Home" name="Home">
        </form>
        <table class='table'>    
            <thead class='History'>
                <tr>
                    <th>Message_ID</th>
                    <th>User_ID</th>
                    <th>Date Viewed</th>
                    <th>Message Details</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Message_ID'] . "</td>";
                echo "<td>" . $row['User_ID'] . "</td>";
                echo "<td>" . $row['DateOfMessage'] . "</td>";
                echo "<td>" . $row['Details'] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php require("adminfooter.php");?>
