<?php


session_start();

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');


$activity = "FORWARD TO VAS";


if (isset($_POST['update_vas_test'])) {


    $entity_no             = $_POST['entity_no'];
    $remarks               = $_POST['remarks'];
    $date_reg      = date('Y-m-d', strtotime($_POST['date_registered']));
    $time                  = date("H:i:s");

    $center             = $_POST['center'];
    $cbrno              =  $_POST['cbrno'];


    $vas_username       = $_POST['vas_username'];

    $user_name = $_POST['vas_username'];
   





    $insert_tbl_assesment_sql = "INSERT INTO tbl_assessment SET 
        
           date_reg             = :date_regg,
           time_reg             = :time_reg,
           remarks              = :remarks, 
           entity_no            = :entity_no,
           vas_username         = :vas,
           bakuna_center_no    = :cbrno,
           bakuna_center       =  :bc_name";

    $add_assesment_data = $con->prepare($insert_tbl_assesment_sql);
    $add_assesment_data->execute([
        ':entity_no'             => $entity_no,
        ':vas'                   => $vas_username,
        ':date_regg'              => $date_reg,
        ':time_reg'              => $time,
        ':remarks'               => $remarks,
        ':cbrno'                     => $cbrno,

        ':bc_name'               => $center


    ]);

    // include('update_logs.php');


    
    if ($add_assesment_data) {

        $_SESSION['status'] = "Add Successful!";
        $_SESSION['status_code'] = "success";

        header('location: list_vaccine_profile.php');
    } else {
        $_SESSION['status'] = "Add Unsuccessful!";
        $_SESSION['status_code'] = "error";

        header('loca/tion: list_vaccine_profile.php');
    }

}

