<?php

//local
// $host = "localhost";
// $db_name = "sccdrrmo";
// $username = "root";
// $password = "1234";

//server local port
// $host = "127.0.0.1:3307";
// $db_name = "sccdrrmo";
// $username = "root";
// $password = "5zAhx4Et37Wr";

//server
$host = "127.0.0.1";
$db_name = "sccdrrmo";
$username = "root";
$password = "0Fd8xWc1anuE";

try {
    //database connection
    $con = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
    //initialize and error exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //"nakasulod sa internet";
    

}
catch (PDOEXCEPTION $error) {

    echo "Connection Error: " . $error->getMessage();

}



?>