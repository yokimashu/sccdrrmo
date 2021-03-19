<?php
session_start();
$alert_msg = '';
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$cbcr = $_SESSION['cbcr'];


$bc_name = $bc_code = ' ';




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
    $date_reg      = date('Y-m-d', strtotime($_POST['date_registered']));
    $time                  = date("H:i:s");




    $alert_msg = '';
    $alert_msg1 = '';




    $insert_tbl_assesment_sql = "INSERT INTO tbl_assessment SET 
        
           date_reg             = :date_regg,
           time_reg             = :time_reg,
           remarks              = :remarks, 
           entity_no            = :entity_no,
           bakuna_center_no     = :cbcr,
           bakuna_center       =  :bc_name";

    $add_assesment_data = $con->prepare($insert_tbl_assesment_sql);
    $add_assesment_data->execute([
        ':entity_no'             => $entity_no,
        ':date_regg'              => $date_reg,
        ':time_reg'              => $time,
        ':remarks'               => $remarks,
        ':cbcr'                  => $bc_code,
        ':bc_name'               => $bc_name


    ]);



    if ($add_assesment_data) {

        $_SESSION['status'] = "Add Successful!";
        $_SESSION['status_code'] = "success";

        header('location: list_vaccine_profile.php');
    } else {
        $_SESSION['status'] = "Add Unsuccessful!";
        $_SESSION['status_code'] = "error";

        header('location: list_vaccine_profile.php');
    }
}
