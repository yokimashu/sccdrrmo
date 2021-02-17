<?php

include "dbconfig.php";

$entity_no = $_POST["entity_no"];

//retrieve data from notifications
$sql_data = "SELECT * FROM tbl_notification WHERE entity_no = :entity_no";
$get_sql_data = $con->prepare($sql_data);
$get_sql_data->execute([':entity_no' => $entity_no]);
$results = $get_sql_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
