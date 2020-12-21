<?php
include('../config/db_config.php');

if(isset($_POST['approve'])){
    $entity_no = $_POST['entityno'];
 $sql = "UPDATE tbl_verification set status = 'VERIFIED' where entity_no = :entity";
$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no]);

}
if(isset($_POST['deny'])){
$entity_no = $_POST['entityno'];
 $sql = "UPDATE tbl_verification set status = 'DENIED' where entity_no = :entity";
$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no]);

}

?>