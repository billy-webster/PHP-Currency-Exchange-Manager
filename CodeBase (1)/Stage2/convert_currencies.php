<?php 
session_start();
$convertedamount = '';
$fromCurrency = '';
$toCurrency = '';
$amount = '';

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

elseif (isset($_POST['viewhistory'])){
    
    header("Location: viewhistory.php");
    exit();}

elseif (isset($_POST['view_currencies'])){
    
    header("Location: viewcurrencies.php");
    exit();}

$db = new SQLite3("Stage2.db");

$sql = "SELECT Currency_ID, Currency_Name FROM Currencies";
$result = $db->query($sql);


$currencynames = array();
while ($i = $result->fetchArray(SQLITE3_ASSOC)){
    $currencynames[] = $i['Currency_Name'];
}

if (isset($_POST['submit'])){
    $fromCurrency = $_POST['from_currency'];
    $toCurrency = $_POST['to_currency'];
    $amount = $_POST['amount'];
    $convertedamount = converter($fromCurrency, $toCurrency, $amount, $db);
    $fromCurrency = 'From: ' .$fromCurrency;
    $toCurrency = "To: " .$toCurrency;
    $amount = 'Amount: ' . $amount;
    $convertedamount = 'Result: ' . $convertedamount;
    
    
}

function converter($fromCurrency, $toCurrency, $amount, $db){
    $sqlFrom = "SELECT Currency_Information.Conversion_Rate 
            FROM Currency_Information 
            INNER JOIN Currencies ON Currency_Information.Currency_ID = Currencies.Currency_ID 
            WHERE Currency_Name = '$fromCurrency'";

    $sqlTo = "SELECT Currency_Information.Conversion_Rate 
          FROM Currency_Information 
          INNER JOIN Currencies ON Currency_Information.Currency_ID = Currencies.Currency_ID 
          WHERE Currency_Name = '$toCurrency'";


    $From = $db->querySingle($sqlFrom);
    $To = $db->querySingle($sqlTo);
    
    $FromRate = (float)$From;
    $ToRate = (float)$To;

    $converted = $amount * ($FromRate / $ToRate);
    return $converted;
    
}

$db->close();


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="convert.css">
</head>
<body>
    <div class="titletext">Convert Currencies</div>
    <div class="background-box">
        <form method="post">
            <input type="submit" class="submitbutton" value="Home" name="Home">
            <input type="submit" class="submitbutton" value="Search Currency Name" name="searchcurrency">
            <input type="submit" class="submitbutton" value="View History" name="viewhistory">
            <input type="submit" class="submitbutton" value="View Currencies" name="view_currencies">
        </form>
        <div class="titletext">Select Currency To Convert</div>
        <form method="post"> 
            <label for="from_currency">From:</label>
            <select class='dropdown' name="from_currency" id="from_currency">
                <?php foreach ($currencynames as $x) {
                    echo "<option value='$x'>$x</option>";
                }?>
            </select>
            <div></div>
            <input type="text" class="input" name="amount" placeholder="Enter your amount.">
            <div></div>
            <label for="to_currency">To:</label>
            <select name="to_currency" id="to_currency">
                <?php foreach ($currencynames as $x) {
                    echo "<option value='$x'>$x</option>";
                }?>
            </select>
            <div></div>
            <input type="submit" class="submitbutton" value="Submit" name="submit">
        </form> 
        <div><?php echo $fromCurrency; ?></div>
        <div> <?php echo $toCurrency; ?></div>
        <div><?php echo $amount; ?></div>
        <div> <?php echo $convertedamount; ?></div>
        <div id="converted_amount"></div>
    </div>
</body>
</html>


<?php require("Footer.php");?>