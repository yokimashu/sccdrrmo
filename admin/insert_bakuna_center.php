<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_bakuna_center'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alert_msg = ' ';
    //insert to tbl_individual
    $idno = $_POST['idno'];
    $bc_code = $_POST['bc_code'];
    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $bc_name = $_POST['bc_name'];
    $bc_address = $_POST['bc_address'];



    
    $insert_bakuna_center_sql = "INSERT INTO tbl_bakuna_center SET 
    idno             = :idno,
    bc_code        = :bc_code,
    date_register  = :date_register,
    bc_name        = :bc_name ,
    bc_address     = :bc_address
    
    ";


    $bakuna_center_data = $con->prepare($insert_bakuna_center_sql);
    $bakuna_center_data->execute([

        ':idno'            => $idno,
        ':date_register' => $date_register,
        ':bc_code'       => $bc_code,
        ':bc_name'       => $bc_name,
        ':bc_address'    => $bc_address

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
        </div>    
      ';

    $btn_enabled = 'disabled';
    $btnNew = 'enabled';
    $btnPrint = 'enabled';


    if ($bakuna_center_data) {

        $_SESSION['status'] = "Registered Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_bakuna_center.php');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: list_bakuna_center.php');
    }


    //echo print_r($firstname);


}
