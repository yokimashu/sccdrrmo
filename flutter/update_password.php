<?php

include "dbconfig.php";

$username = $_POST["username"];
$password = $_POST["password"];

$hashed_password  = password_hash($password, PASSWORD_DEFAULT);

$sql_statement = "UPDATE tbl_entity SET 

    password            = :password

    WHERE username     = :username

";

$sql_data = $con->prepare($sql_statement);
$sql_data->execute([

    ':password'         => $hashed_password,
    ':username'        => $username


]);

echo json_encode('Success');

?>