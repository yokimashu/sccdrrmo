<?php

//local
$host = "127.0.0.1";
$db_name = "sample_db";
$username = "root";
$password = "I0nvNUWNXoYI";

try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8mb4'); 
    //database connection
    $con = new PDO("mysql:host=$host; dbname=$db_name", $username, $password, $options);
    //initialize and error exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "something";



} catch (PDOEXCEPTION $error) {

    echo "Connection Error: " . $error->getMessage();
}


$input = $_POST['input'];

// - - - INSERT  History - - - / /
$sql = "INSERT INTO tbl_sample SET 
      
      text       = :text
      
    ";

$sql_data = $con->prepare($sql);
$sql_data->execute([

    ':text'      => $input

]);
// - select all


echo json_encode($input);
