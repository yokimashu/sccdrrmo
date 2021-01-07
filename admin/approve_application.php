<?php
include('../config/db_config.php');

$alert_msg = '';
if (isset($_POST['approve'])) {
    $entity_no = $_POST['entityno'];
    $photolink = $_POST['photolink'];

    date_default_timezone_set('Asia/Manila');
    $message = 'Good day! Your account is now verified. Please logout and re-login to update your profile. Thank you!';
    $title = 'VAMOS ACCOUNT VERIFICATION';


    $time = date('H:i:s');


    $sql = "UPDATE tbl_verification set status = 'VERIFIED' ,remarks  =  'Your account is already verified' where entity_no = :entity";
    $exe_sql = $con->prepare($sql);
    $exe_sql->execute([':entity' => $entity_no]);


    $sql = "UPDATE tbl_entity set status = 'VERIFIED' where entity_no = :entity";
    $exe_sql = $con->prepare($sql);
    $exe_sql->execute([':entity' => $entity_no]);




    $insert_notif_sql = "INSERT INTO tbl_notification SET 

        entity_no           = :entity_no,
        message             = :message,
        date                = now(),
        time                = :time,
        title               = :title,
        status              = 'UNREAD'


        ";

    $notif_data = $con->prepare($insert_notif_sql);
    $notif_data->execute([

        ':entity_no'         => $entity_no,
        ':message'           => $message,
        ':time'              => $time,
        ':title'             => $title

    ]);


    $alert_msg .= ' 
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> User has been Verified!
</div>    
';
    unlink('../flutter/verification_images/' . $photolink);
}
if (isset($_POST['deny'])) {
    // $remarks = $_POST['remarks'];
    $entity_no = $_POST['entityno'];
    $photolink = $_POST['photolink'];

    $message = 'Good day! Your account was disapproved, kindly check and upload necesarry requirements! ';
    date_default_timezone_set('Asia/Manila');
    $time = date(' H:i:s');
    $title = 'VAMOS ACCOUNT VERIFICATION';

    $sql = "UPDATE tbl_verification set  remarks = 'Your account was disapproved, kindly check and upload necesarry requirements! ', status = 'DENIED' where entity_no = :entity";
    $exe_sql = $con->prepare($sql);
    $exe_sql->execute([':entity' => $entity_no]);



    $insert_notif_sql = "INSERT INTO tbl_notification SET 

            entity_no           = :entity_no,
            message             = :message,
            date                = now(),
            time                = :time,
            title               = :title,
            status              = 'UNREAD'


";

    $notif_data = $con->prepare($insert_notif_sql);
    $notif_data->execute([

        ':entity_no'         => $entity_no,
        ':message'           => $message,
        ':time'              => $time,
        ':title'             => $title


    ]);


    $alert_msg .= ' 
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                The application has been denied.
        </div>    
      ';
    unlink('../flutter/verification_images/' . $photolink);
}
