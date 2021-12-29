<?php

//local
$host = "127.0.0.1";
$db_name = "sample_db";
$username = "root";
$password = "I0nvNUWNXoYI";

try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4');
    //database connection
    $con = new PDO("mysql:host=$host; dbname=$db_name", $username, $password, $options);
    //initialize and error exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "something";



} catch (PDOEXCEPTION $error) {

    echo "Connection Error: " . $error->getMessage();
}

$sql_2 = "SELECT * FROM tbl_sample";
$get_sql_2 = $con->prepare($sql_2);
$get_sql_2->execute();
$results = $get_sql_2->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
