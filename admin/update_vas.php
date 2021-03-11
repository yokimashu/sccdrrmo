<?php

$alert_msg = '';
include('../config/db_config.php');
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['update_vas'])) {


    $entity_no             = $_POST['entity_no'];
    $remarks               = $_POST['remarks'];
    $date_reg              = date('Y-m-d');
    $time                  = date("H:i:s");


    $alert_msg = '';
    $alert_msg1 = '';




    $insert_tbl_assesment_sql = "INSERT INTO tbl_assessment SET 
        
           date_reg             = :date_reg,
           time_reg             = :time_reg,
           remarks              = :remarks, 
           entity_no            = :entity_no ";

    $add_assesment_data = $con->prepare($insert_tbl_assesment_sql);
    $add_assesment_data->execute([
        ':entity_no'             => $entity_no,
        ':date_reg'              => $date_reg,
        ':time_reg'              => $time,
        ':remarks'               => $remarks


    ]);





    header('location: list_assessment.php');




    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Inserted.
</div>    
    ';
}
