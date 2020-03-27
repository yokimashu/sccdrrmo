<?php

$host = "localhost";
$db_name = "android";
$username = "root";
$password = "";

try {
    //database connection
    $con = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
    //initialize and error exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "nakasulod sa internet";
    

}
catch (PDOEXCEPTION $error) {

    echo "Connection Error: " . $error->getMessage();

}


//changes from emem


?>