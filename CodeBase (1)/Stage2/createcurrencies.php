<?php
$db = new SQLite3("Stage2.db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $currencyId = $_POST['currencyid'];
    $currencyname = $_POST['currencyname'];
    $conversionrate = $_POST['conversionrate'];
    $currencyvalue = $_POST['currencyvalue'];
    $country = $_POST['country'];

    $sqlstatement2 = "SELECT Currency_Name FROM Currencies WHERE Currency_Name = '$currencyname'";
    $result2 = $db->query($sqlstatement2);
    $tabledata2 = $result2->fetchArray(SQLITE3_ASSOC);

    if ($tabledata2) {
        echo "Currency already exists. Please choose a different Currency.";
    } else {
        
        $sqlInsertCurrencyInfo = "INSERT INTO Currency_Information (Currency_ID, Conversion_Rate, Currency_Value, Country_Origin) VALUES ($currencyId, '$conversionrate', '$currencyvalue', '$country')";
        $insertResultCurrencyInfo = $db->query($sqlInsertCurrencyInfo);

        
        $sqlInsertCurrency = "INSERT INTO Currencies (Currency_ID, Currency_Name) VALUES ($currencyId, '$currencyname')";
        $insertResultCurrency = $db->query($sqlInsertCurrency);

        if ($insertResultCurrencyInfo && $insertResultCurrency) {
            echo "Added Currency successfully.";
        } else {
            echo "Error Adding Currency.";
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
    <div class="titletext">Add Currency</div>
    <div class='Form'>    
        <form method="post" action="">    
            <input type="text" placeholder="Enter Currency ID" name="currencyid" required>      
            <input type="text" placeholder="Enter Currency Name" name="currencyname" required>      
            <input type="text" placeholder="Enter Conversion Rate" name="conversionrate" required>  
            <input type="text" placeholder="Enter Currency Value" name="currencyvalue" required>    
            <input type="text" placeholder="Enter Country Of Origin" name="country" required>    
            
            <button class="submit" type="submit">Add Currency</button>
        </form>
        <a href="AdminHomePage.php" class="Login">Home</a>
        
    </div>
</body>
</html>
