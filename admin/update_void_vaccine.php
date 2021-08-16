<?php

$alert_msg = '';
include('../config/db_config.php');
if (isset($_POST['update_void_vaccine'])) {



    // $get_date_register          = date('Y-m-d', strtotime($_POST['date_register']));
    $get_objid             = $_POST['void_entity_no'];

    $get_status             = "VOID";
    $get_username           = $_POST['void_username'];


    $alert_msg = '';
    $alert_msg1 = '';




    $update_status_sql = "UPDATE tbl_vaccine SET  
        void_username    = :username,
        status            = :status
        WHERE entity_no =  :entity ";

    $add_status_data = $con->prepare($update_status_sql);
    $add_status_data->execute([
        ':username'             => $get_username,
        ':entity'               => $get_objid,
        ':status'               => $get_status
    ]);





    if ($add_status_data) {

        $_SESSION['status'] = "Void Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_vaccine_profile.php');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: list_vaccine_profile.php');
    }
    
}
