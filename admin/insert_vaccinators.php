<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_vaccinators'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alert_msg = ' ';
    //insert to tbl_individual
    $id = $_POST['id'];
    $n_facility = $_POST['n_facility'];
    $pr_license_number = $_POST['pr_license_number'];
    $l_name = $_POST['l_name'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $position = $_POST['position'];
    $role = $_POST['role'];




    $insert_vaccinators_sql = "INSERT INTO tbl_vaccinators SET 
    id             = :id,
    n_facility        = :n_facility,
    pr_license_number  = :pr_license_number,
    l_name        = :l_name ,
    f_name     = :f_name,
    m_name     = :m_name,
    position     = :position,
    role     = :role
    
    ";


    $vaccinators_data = $con->prepare($insert_vaccinators_sql);
    $vaccinators_data->execute([

        ':id'            => $id,
        ':n_facility' => $n_facility,
        ':pr_license_number'       => $pr_license_number,
        ':l_name'       => $l_name,
        ':m_name'    => $m_name,
        ':f_name'    => $f_name,
        ':position'    => $position,
        ':role'    => $role

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

    if ($vaccinators_data) {

        $_SESSION['status'] = "Registered Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_vaccinators');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: list_vaccinators');
    }

    //echo print_r($firstname);


}
