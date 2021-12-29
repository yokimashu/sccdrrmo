<?php

include "dbconfig.php";

$entity_no = $_POST["entity_no"];

$token = '';

   // update user's token
   $sql_statement = "UPDATE tbl_entity SET 
   token               = :token
   WHERE entity_no     = :entity_no
";

$sql_data = $con->prepare($sql_statement);
$sql_data->execute([
   ':token'            => $token,
   ':entity_no'        => $entity_no
]);

echo json_encode($entity_no . ' tokens has been updated!');
