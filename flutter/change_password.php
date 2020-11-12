<?php

include "dbconfig.php";

$newPassword = $_POST['newPassword'];
$entity_no = $_POST['entityNo'];

$hashed_password  = password_hash($newPassword, PASSWORD_DEFAULT);


$sql_statement = "UPDATE tbl_entity SET 

    password            = :password
   
    WHERE entity_no     = :entity_no

";

$sql_data = $con->prepare($sql_statement);
$sql_data->execute([

    ':password'         => $hashed_password,
    ':entity_no'        => $entity_no

]);

echo json_encode('Success');
