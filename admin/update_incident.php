<?php
include ('../config/db_config.php');
// echo "<pre>";
// print_r("hello");
// echo "</pre>";
if(isset($_POST['userId'])){

$update_incident= "update tbl_incident SET remarks =:remarks where objid = :id";
$update_documents_data = $con->prepare($update_credentials);
    $update_documents_data->execute([
        ':remarks'             => 'APPROVED',
        ':id'             => $_POST['userId'],


    ]);
    header('location: list_incident.php');
}
?>