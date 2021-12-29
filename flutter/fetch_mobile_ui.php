<?php

include "dbconfig.php";


$sql_data = "SELECT * FROM tbl_mobile_ui";
$get_sql_data = $con->prepare($sql_data);
$get_sql_data->execute();
$results = $get_sql_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
