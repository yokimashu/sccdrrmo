<?php

include "dbconfig.php";

$entity_no = $_POST['entity_no'];

$get_sql = "SELECT status FROM tbl_entity WHERE entity_no = :entity_no";
$get_sql_data = $con->prepare($get_sql);
$get_sql_data->execute([':entity_no' => $entity_no]);
while ($result2 = $get_sql_data->fetch(PDO::FETCH_ASSOC)) {
    $encode = $result2['status'];
}
echo json_encode($encode);

?>