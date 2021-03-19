<?php

$alert_msg = '';
include('../config/db_config.php');
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['update_schedule'])) {


    $entity_no      = $_POST['entity_no'];
    $cbcr           = $_POST['n_facility'];
    $date_reg       = date('Y-m-d', strtotime($_POST['date_set']));
    // $time           = date("h:i:s a", strtotime($_POST['time_set']));
    $time           = $_POST['time_set'];
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

    
$get_cbcr_sql = "SELECT * FROM tbl_bakuna_center where bc_code = :cbcr";
$cbcr_data = $con->prepare($get_cbcr_sql);
$cbcr_data->execute([':cbcr' => $cbcr]);
while ($result = $cbcr_data->fetch(PDO::FETCH_ASSOC)) {

    $bc_code = $result['bc_code'];
    $bc_name = $result['bc_name'];
}

    $timenow = date('H:i:s');
    $title = 'COVID-19 VACCINATION SCHEDULE';
    $message = "Good day! Kindly check your schedule for COVID-19 vaccination.
     \r\n\r\n Vacination Site: " . $bc_name . " 
     \r\n\r\n Date           : " . $date_reg . "
     \r\n\r\n Time           : " . $time . "
     \r\n\r\n Remarks        : " . $remarks . "
     \r\n\r\n Kindly bring your VAMOS ID and one (1) valid ID for verification. 
     \r\n\r\n Keep Safe!";
    
     $insert_notif_sql = "INSERT INTO tbl_notification SET 

            entity_no           = :entity_no,
            message             = :message,
            date                = now(),
            time                = :time,
            title               = :title,
            status              = 'UNREAD'";

    $notif_data = $con->prepare($insert_notif_sql);
    $notif_data->execute([

        ':entity_no'         => $entity_no,
        ':message'           => $message,
        ':time'              => $timenow,
        ':title'             => $title


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
