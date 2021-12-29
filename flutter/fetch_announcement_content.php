<?php

include "dbconfig.php";

$id = $_POST['id'];

$ann_data = "SELECT * FROM `tbl_announcement` WHERE `id` =  $id";
$get_ann_data = $con->prepare($ann_data);
$get_ann_data->execute();
$results = $get_ann_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>