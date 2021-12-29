<?php

include "dbconfig.php";

$limitno = $_POST['limitno'];

$ann_data = "SELECT * FROM tbl_announcement where status = 'published' ORDER BY id DESC LIMIT $limitno ";
$get_ann_data = $con->prepare($ann_data);
$get_ann_data->execute();
$results = $get_ann_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>
