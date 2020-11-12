<?php

include "dbconfig.php";

//retrieve data from nature of business
$sql_data = "SELECT * FROM organization_type ORDER BY name";
$get_sql_data = $con->prepare($sql_data);
$get_sql_data->execute();
$results = $get_sql_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>