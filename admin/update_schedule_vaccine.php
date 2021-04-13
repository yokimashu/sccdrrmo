<?php

$alert_msg = '';
include('../config/db_config.php');
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['update_schedule_vaccine'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    //first dose
    $entity_no            = $_POST['entity_number'];
    $first_cbcr           = $_POST['first_facility'];
    $first_date           = date('Y-m-d', strtotime($_POST['first_date_sched']));
    $first_time           = date('h:i:s A', strtotime($_POST['first_time_set']));
    $first_remarks        = $_POST['first_remarks'];

    //2nd dose
    $entity_no_2nd         = $_POST['entity_number_2nd'];
    $second_cbcr           = $_POST['2nd_facility'];
    $second_date           = date('Y-m-d', strtotime($_POST['2nd_date_sched']));
    $second_time           = $_POST['2nd_time_set'];
    $second_remarks        = $_POST['2nd_remarks'];



        $update_first_schedule_sql = "UPDATE tbl_schedule SET 
        
         cbcr                 = :cbcr1,
         date                 = :date1,
         time                 = :time1,
         remarks              = :remarks1
        WHERE entity_no       = :entity_no1
        AND remarks           = '1st_Dose'

         ";

        $update_first_schedule_data = $con->prepare($update_first_schedule_sql);
        $update_first_schedule_data->execute([
            ':entity_no1'             => $entity_no,
            ':cbcr1'                  => $first_cbcr,
            ':date1'                  => $first_date,
            ':time1'                  => $first_time,
            ':remarks1'               => $first_remarks


        ]);

     
        $update_second_schedule_sql = "UPDATE tbl_schedule SET 
        
         cbcr                 = :cbcr2,
         date                 = :date2,
         time                 = :time2,
         remarks              = :remarks2
        WHERE entity_no       = :entity_no2
        AND remarks           = '2nd_Dose'

         ";

        $update_second_schedule_data = $con->prepare($update_second_schedule_sql);
        $update_second_schedule_data->execute([
            ':entity_no2'             => $entity_no_2nd,
            ':cbcr2'                  => $second_cbcr,
            ':date2'                  => $second_date,
            ':time2'                  => $second_time,
            ':remarks2'               => $second_remarks

        ]);

    


    // $timenow = date('H:i:s');
    // $title = 'COVID-19 VACCINATION SCHEDULE';
    // $message = "Good day! Kindly check your schedule for COVID-19 vaccination.
    //  \r\n\r\n Vacination Site: " . $bc_name . " 
    //  \r\n\r\n Date           : " . $date_reg . "
    //  \r\n\r\n Time           : " . $time . "
    //  \r\n\r\n Remarks        : " . $remarks . "
    //  \r\n\r\n Kindly bring your VAMOS ID and one (1) valid ID for verification. 
    //  \r\n\r\n Keep Safe!";

    // $insert_notif_sql = "INSERT INTO tbl_notification SET 

    //         entity_no           = :entity_no,
    //         message             = :message,
    //         date                = now(),
    //         time                = :time,
    //         title               = :title,
    //         status              = 'UNREAD'";

    // $notif_data = $con->prepare($insert_notif_sql);
    // $notif_data->execute([

    //     ':entity_no'         => $entity_no,
    //     ':message'           => $message,
    //     ':time'              => $timenow,
    //     ':title'             => $title


    // ]);



//     $alert_msg .= ' 
//     <div class="alert alert-success alert-dismissible">
//     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//         <i class="fa fa-check"></i>
//         <strong> Success! </strong> Upd.
// </div>    
//     ';

//     header('location: list_schedule.php');

if ($update_first_schedule_data && $update_second_schedule_data ) {

    $_SESSION['status'] = "Update Successful!";
    $_SESSION['status_code'] = "success";

    header('location: view_schedule.php?id=' . $entity_no);
} else {
    $_SESSION['status'] = "Update Unsuccessful!";
    $_SESSION['status_code'] = "error";

    header('location: view_schedule.php?id=' . $entity_no);
}

}
