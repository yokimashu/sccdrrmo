<?php

$alert_msg = '';
include('../config/db_config.php');




if (isset($_POST['update_void'])) {

    $user_name = $_POST['void_username'];
    
    $get_objid              = $_POST['objid'];
    $get_remarks            = 'DOUBLE ENTRY';
    $get_status             = 'VOID';
    $void_username          = $_POST['void_username'];



    $alert_msg = '';
    $alert_msg1 = '';




    $insert_status_sql = "UPDATE tbl_assessment SET 
        
       
           status            = :status,
           remarks            = :remarks,
           void_username      =:name
            WHERE objid =  $get_objid ";

    $add_status_data = $con->prepare($insert_status_sql);
    $add_status_data->execute([

        ':status'                 => $get_status,
        ':name'                 => $void_username,
        ':remarks'                 => $get_remarks


    ]);



    if ($add_status_data) {

        $_SESSION['status'] = "Void Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_assessment.php');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: list_assessment.php');
    }
}
