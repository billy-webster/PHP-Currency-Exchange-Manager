<?php 
session_start();
$output = '';
$nameoutput = '';
$countryoutput = '';
$conversionoutput = '';
$valueoutput = '';
$account_username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    exit(); 
}


if (isset($_POST['Home'])){
    
    header("Location: UserHomePage.php");
    exit();

}

elseif (isset($_POST['viewcurrency'])){
    
    header("Location: viewcurrencies.php");
    exit();}

elseif (isset($_POST['view_currencies'])){
    
    header("Location: view_currencies");
    exit();}


elseif (isset($_POST['convert_currencies'])){
    
    header("Location: convert_currencies.php");
    exit();}
    
    
elseif (isset($_POST['viewhistory'])){
    
    header("Location: viewhistory.php");
    exit();}


if (isset($_POST['submit'])){
    $db = new SQLite3("Stage2.db");
    $searchedcurrency = $_POST['currency'];
    $searchedcurrency = strtoupper($searchedcurrency);
    $searchsql = "SELECT * FROM Currencies WHERE Currency_Name = '$searchedcurrency'";
    $result = $db->query($searchsql);
    if ($result->fetchArray(SQLITE3_ASSOC)) {

        $sql = "SELECT Currencies.Currency_Name,Currency_Information.Conversion_Rate, Currency_Information.Currency_Value, Currency_Information.Country_Origin 
        FROM Currency_Information INNER JOIN Currencies ON Currency_Information.Currency_ID = Currencies.Currency_ID WHERE Currencies.Currency_Name = '$searchedcurrency'";

        $result = $db->query($sql);
        $data =  $result->fetchArray(SQLITE3_ASSOC);
        
        $conversionrate = $data["Conversion_Rate"];
        $currencyvalue = $data["Currency_Value"];
        $country = $data["Country_Origin"];


        $nameoutput = 'The Name of this currency is ' . $searchedcurrency;
        $countryoutput = 'The Country which this Currency Originates is ' . $country;
        $conversionoutput = 'The Conversion Rate for this Currency is ' . $conversionrate . ', To convert an Amount into a different Currency, Please use the Conversion tool on the menu.';
        $valueoutput = 'One Unit of this Currency is equivalent to ' .$currencyvalue . ' Pounds';
        $date = date('d-m-y h:i:s');
        $sql = "SELECT User_ID FROM User_Accounts WHERE Account_Name = '$account_username'";
        $result = $db->query($sql);
        $user_id_data = $result->fetchArray(SQLITE3_ASSOC);
        $user_id = $user_id_data['User_ID'];
        $historysql = "INSERT OR IGNORE INTO User_History (User_ID, Currency_Name, Date_Viewed) VALUES ('$user_id','$searchedcurrency','$date')";
        $db->exec($historysql);
        

        
    } else {
        $output = 'Please Enter A Correct Currency Name';
    }
}

    

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="titletext">Search For Currency</div>
    <div class="background-box">
    <form method="post">
    <input type="submit" class="submitbutton" value="Home" name="Home">
            <input type="submit" class="submitbutton" value="View Currencies" name="viewcurrency">
            <input type="submit" class="submitbutton" value="View History" name="viewhistory">
            <input type="submit" class="submitbutton" value="Convert Currency Tool" name="convert_currencies">
    </form>
    
    <div class="titletext">Enter Name Of Currency</div>
    <div></div>
    <div class="newtext" >Type in the 3 digit letter code for the currency you wish to find. An example of a 3 digit code is USD.</div>
    <form method="post">
        <input type="text" class="input" name="currency" placeholder="Enter the 3 digit Code for the Currency.">
        <input type="submit" class="submitbutton" value="Search For Currency" name='submit'>
    </form>
    <div><?php echo $output; ?> </div>
    <div><?php echo $nameoutput; ?> </div>
    <div><?php echo $countryoutput; ?> </div>
    <div><?php echo $conversionoutput; ?> </div>
    <div><?php echo $valueoutput; ?> </div>
</div>
    
</body>
</html>

<?php require("Footer.php");?>