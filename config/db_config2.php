<?php

$host = "localhost:8888";
$db_name = "sccdrrmo";
$username = "root";
$password = "h4G2a3qc0tRc";

try {
    //database connection
    $con = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
    //initialize and error exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected";
}
catch (PDOEXCEPTION $error) {

    echo "Connection Error: " . $error->getMessage();

}


?>