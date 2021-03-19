<?php

$alert_msg = '';
include('../config/db_config.php');

if (isset($_POST['update_bakuna_center'])) {

    $get_bc_code            = $_POST['bc_code'];
    $get_bc_name            = $_POST['bc_name'];
    $get_bc_address         = $_POST['bc_address'];
    $alert_msg = '';
    $alert_msg1 = '';

    if (empty($get_bc_id)) {

        $update_bakuna_center_sql = "UPDATE tbl_bakuna_center SET 
 
    bc_name            = :bc_name,
    bc_address         = :bc_address
    where bc_code      = :bc_code ";

        $update_bakuna_center_data = $con->prepare($update_bakuna_center_sql);
        $update_bakuna_center_data->execute([
            ':bc_code'                => $get_bc_code,
            ':bc_name'                => $get_bc_name,
            ':bc_address'             => $get_bc_address

        ]);
    } else {

        $update_bakuna_center_sql = "UPDATE tbl_bakuna_center SET 
 
    
    bc_name            = :bc_name,
    bc_address         = :bc_address
    where bc_code      = :bc_code ";

        $update_bakuna_center_data = $con->prepare($update_bakuna_center_sql);
        $update_bakuna_center_data->execute([
            ':bc_code'                => $get_bc_code,
            ':bc_name'                => $get_bc_name,
            ':bc_address'             => $get_bc_address

        ]);

    if ($update_bakuna_center_data) {

        $_SESSION['status'] = "Registered Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_bakuna_center');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: list_bakuna_center');
    }
}
}
