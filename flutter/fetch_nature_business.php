<?php

include "dbconfig.php";

//retrieve data from nature of business
$naturebusiness_data = "SELECT DISTINCT name FROM nature_of_business ORDER BY name";
$get_naturebusiness_data = $con->prepare($naturebusiness_data);
$get_naturebusiness_data->execute();
$results = $get_naturebusiness_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>