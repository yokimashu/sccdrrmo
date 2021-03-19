<?php
session_start();
$alert_msg = '';
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$cbcr = $_SESSION['cbcr'];





$get_cbcr_sql = "SELECT * FROM tbl_bakuna_center where bc_code = :cbcr";
$cbcr_data = $con->prepare($get_cbcr_sql);
$cbcr_data->execute([':cbcr' => $cbcr]);
while ($result = $cbcr_data->fetch(PDO::FETCH_ASSOC)) {

    $bc_code = $result['bc_code'];
    $bc_name = $result['bc_name'];
}


if (isset($_POST['update_vas'])) {


    $entity_no             = $_POST['entity_no'];
    $remarks               = $_POST['remarks'];
    $time                  = date("H:i:s");



    $alert_msg = '';
    $alert_msg1 = '';




    $insert_tbl_assesment_sql = "INSERT INTO tbl_assessment SET 
        
           date_reg             = now(),
           time_reg             = :time_reg,
           remarks              = :remarks, 
           entity_no            = :entity_no,
           bakuna_center_no     = :cbcr,
           bakuna_center       =  :bc_name";

    $add_assesment_data = $con->prepare($insert_tbl_assesment_sql);
    $add_assesment_data->execute([
        ':entity_no'             => $entity_no,
        // ':date_reg'              => $date_reg,
        ':time_reg'              => $time,
        ':remarks'               => $remarks,
        ':cbcr'                  => $bc_code,
        ':bc_name'               => $bc_name


    ]);





    header('location: list_vaccine_profile.php');




    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Inserted.
</div>    
    ';
}
