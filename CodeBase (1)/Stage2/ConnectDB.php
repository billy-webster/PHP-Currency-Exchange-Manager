<?php
$db = new SQLite3("Stage2.db");

if ($db) {
    echo "Connected"; 
    }
    
else{   
    echo "Not Connected";   
    }
$db->close();
?>
