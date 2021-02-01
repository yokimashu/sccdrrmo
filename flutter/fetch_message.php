<?php

include "dbconfig.php";

$notif_objid = $_POST["notif_objid"];

//retrieve data from notifications
$sql_data = "SELECT * FROM tbl_message WHERE notif_objid = :notif_objid";
$get_sql_data = $con->prepare($sql_data);
$get_sql_data->execute([':notif_objid' => $notif_objid]);
$results = $get_sql_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
