<?php

include "dbconfig.php";

$entity_no = $_POST['entity_no'];

$sql = "SELECT count(*) FROM tbl_notification WHERE entity_no = ?";
$result = $con->prepare($sql);
$result->execute([$entity_no]);
$number_of_rows = $result->fetchColumn();


echo json_encode($number_of_rows);
