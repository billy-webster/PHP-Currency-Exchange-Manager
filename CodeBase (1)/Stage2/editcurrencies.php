<?php
$db = new SQLite3("Stage2.db");
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $currencyId = $_POST['currencyId'];
    $currencyname = $_POST['currencyname'];
    $conversionrate = $_POST['conversionrate'];
    $currencyvalue = $_POST['currencyvalue'];
    $country = $_POST['country'];
    

    $sqlstatement2 = "SELECT Currency_Name FROM Currencies WHERE Currency_Name = '$currencyname'";
    $result2 = $db->query($sqlstatement2);
    $tabledata2 = $result2->fetchArray(SQLITE3_ASSOC);

    if ($tabledata2) {
        $updatetable1 = "UPDATE Currency_Information SET Currency_ID = '$currencyId', Conversion_Rate = '$conversionrate', Currency_Value = '$currencyvalue', Country_Origin = '$country' WHERE Currency_ID = '$currencyId';";
        $updateresult = $db->exec($updatetable1);
        $updatetable2 = "UPDATE Currencies SET Currency_ID = '$currencyId', Currency_Name = '$currencyname' WHERE Currency_ID = '$currencyId';";
        $updateresult2 = $db->exec($updatetable2);
        if ($updateresult && $updateresult2){
            $message = "$currencyname's Details Updated.";
        }
        else {
            $message = "Error updating $currencyname";
        }
    } else {
        $message = "No Currency exists with the Name $currencyname";
        
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
    <div class="titletext">Edit Currency</div>
    <div class='Form'>    
        <form method="post" action="">    
            <input type="text" placeholder="Enter Currency ID" name="currencyId" required>      
            <input type="text" placeholder="Enter Currency Name" name="currencyname" required>      
            <input type="text" placeholder="Enter Conversion Rate" name="conversionrate" required>  
            <input type="text" placeholder="Enter Currency Value" name="currencyvalue" required>    
            <input type="text" placeholder="Enter Country Of Origin" name="country" required>    
            
            <button class="submit" type="submit">Edit Currency</button>
            <p><?php echo $message; ?></p>
        </form>
        
        <a href="AdminHomePage.php" class="Login">Home</a>
        
    </div>
</body>
</html>
