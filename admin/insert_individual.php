<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_individual'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alert_msg = ' ';
    //insert to tbl_individual
    $entity_no = $_POST['entity_no'];
    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $fullname = $_POST['firstname'] . ' ' . $_POST['middlename'] . ' ' . $_POST['lastname'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $mobile_no = $_POST['mobile_no'];
    $telephone_no = $_POST['telephone_no'];
    $barangay = $_POST['barangay'];
    $email = $_POST['email'];
    $user_name = $_POST['username'];
    $hashed_password  = password_hash($entity_no, PASSWORD_DEFAULT);
    $type = 'INDIVIDUAL';
    $status = 'ACTIVE';
    $img = $_POST['image'];
    // //for photo
    


        //upload image

        $folderPath = "../flutter/images/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpg';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

    $insert_individual_sql = "INSERT INTO tbl_individual SET 

    entity_no        = :entity_no,
    date_register    = :date_register,
    firstname        = :firstname,
    middlename       = :middlename,
    lastname         = :lastname,
    fullname         = :fullname,
    mobile_no        = :mobile_no,
    telephone_no     = :telephone_no,
    email            = :email,
    gender           = :gender,
    birthdate        = :birthdate,
    age              = :age,
    street           = :street,
    barangay         = :barangay,
    city             = :city,
    province         = :province,  
    photo            = :photo
    
    ";


    $individual_data = $con->prepare($insert_individual_sql);
    $individual_data->execute([

        ':entity_no'         => $entity_no,
        ':date_register'     => $date_register,
        ':firstname'         => $firstname,
        ':middlename'        => $middlename,
        ':lastname'          => $lastname,
        ':fullname'          => $fullname,
        ':age'               => $age,
        ':gender'            => $gender,
        ':mobile_no'         => $mobile_no,
        ':telephone_no'      => $telephone_no,
        ':email'             => $email,
        ':barangay'          => $barangay,
        ':birthdate'         => $birthdate,
        ':street'            => $street,
        ':city'              => $city,
        ':province'          => $province,
        ':photo'             => $fileName

    ]);



    //INSERT ENTITY TABLE

    $insert_entity_sql = "INSERT INTO tbl_entity SET 
    entity_no           = :entity_no,
    username            = :username,
    password            = :password,
    type                = :type,
    status              = :status";


    $entity_data = $con->prepare($insert_entity_sql);
    $entity_data->execute([

        ':entity_no'        => $entity_no,
        ':username'         => $user_name,
        ':password'         => $hashed_password,
        ':type'             => 'INDIVIDUAL',
        ':status'           => 'ACTIVE'

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


    //echo print_r($firstname);


}
