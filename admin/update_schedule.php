<?php

$alert_msg = '';
include('../config/db_config.php');
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['update_vas'])) {


    $entity_no      = $_POST['entity_no'];
    $cbcr           = $_POST['n_facility'];
    $date_reg       = date('Y-m-d', strtotime($_POST['date_set']));
    $time           = date("h:i:s a", strtotime($_POST['time_set']));
    $remarks        = $_POST['remarks'];


    $alert_msg = '';
    $alert_msg1 = '';




    $insert_tbl_assesment_sql = "INSERT INTO tbl_schedule SET 
        
           entity_no            = :entity_no,
           cbcr                 = :cbcr,
           date                 = :date_reg,
           time                 = :time_reg,
           remarks              = :remarks";

    $add_assesment_data = $con->prepare($insert_tbl_assesment_sql);
    $add_assesment_data->execute([
        ':entity_no'             => $entity_no,
        ':cbcr'                  => $cbcr,
        ':date_reg'              => $date_reg,
        ':time_reg'              => $time,
        ':remarks'               => $remarks


    ]);





    // header('location: list_assessment.php');




    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Inserted.
</div>    
    ';
}
