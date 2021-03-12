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
    $id = $_POST['id'];
    $bc_code = $_POST['bc_code'];
    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $bc_name = $_POST['bc_name'];
    $bc_address = $_POST['bc_address'];



    
    $insert_bakuna_center_sql = "INSERT INTO tbl_bakuna_center SET 
    id             = :id,
    bc_code        = :bc_code,
    date_register  = :date_register,
    bc_name        = :bc_name ,
    bc_address     = :bc_address
    
    ";


    $bakuna_center_data = $con->prepare($insert_bakuna_center_sql);
    $bakuna_center_data->execute([

        ':id'            => $id,
        ':date_register' => $date_register,
        ':bc_code'       => $bc_code,
        ':bc_name'       => $bc_name,
        ':bc_address'    => $bc_address

    ]);



    //INSERT ENTITY TABLE

    // $insert_entity_sql = "INSERT INTO tbl_entity SET 
    // entity_no           = :entity_no,
    // username            = :username,
    // password            = :password,
    // type                = :type,s
    // status              = :status";


    // $entity_data = $con->prepare($insert_entity_sql);
    // $entity_data->execute([

    //     ':entity_no'        => $entity_no,
    //     ':username'         => $user_name,
    //     ':password'         => $hashed_password,
    //     ':type'             => 'INDIVIDUAL',
    //     ':status'           => 'ACTIVE'

    // ]);

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


    //echo print_r($firstname);


}
