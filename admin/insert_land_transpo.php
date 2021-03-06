<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_land_transpo'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    //insert to tbl_individual
    $entity_no = $_POST['entity_no'];
    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $transpo = $_POST['land_transpo_type'];
    $vehicle_name = $_POST['vechicle_name'];
    $vehicle_no = $_POST['vehicle_no'];
    $plate_no = $_POST['plate_no'];
    $route = $_POST['route'];
    $contact_name = $_POST['contact_name'];
    $contact_position = $_POST['contact_position'];
    $mobile_no = $_POST['mobile_no'];
    $tel_no = $_POST['telephone_no'];
    $email_address = $_POST['email'];
    $img = $_POST['image'];

        $folderPath = "../flutter/images/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpg';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);


    // $photo = $_POST['myFiles'];

    //insert to tbl_entity 

    $user_name = $_POST['username'];
    $hashed_password  = password_hash($entity_no, PASSWORD_DEFAULT);
    $type = 'INDIVIDUAL';
    $status = 'ACTIVE';

    // //for photo
    // $currentDir = getcwd();
    // $uploadDirectory = "../flutter/images/";
    // $errors = [];
    // $img = $_POST['image'];
    // $fileExtensions = ['png','jpg','jpeg'];
    // $fileName = $_FILES['myFile']['name'];
    // $fileSize = $_FILES['myFile']['size'];
    // $fileTmpName = $_FILES['myFile']['tmp_name'];
    // $fileType = $_FILES['myFile']['type'];
    // $target_file = $uploadDirectory . basename($_FILES['myFile']['name']);
    // $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $uploadPath = $uploadDirectory . $fileName;
    //     $newfilename = '';

    // if ($_FILES['myFile']['name'] == null && $img == null  )
    //     {  
    //     $fileName = 'user.jpeg';
    //     }else  if($_FILES["myFile"]["error"] == 0 ) 
    //     {
    //         if (!in_array($fileExtension, $fileExtensions)) {
    //             $errors[] = "This file extension is not allowed.";
    //         }
    //         if (empty($errors)) {
    //             $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);
    //         }

    //  $temp = explode(".", $_FILES["myFile"]["name"]);
    //             //      



    //             // $fileExtension = strtolower(end(explode('.',$fileName)));

    //     } 
    //     if ($img != ''){



    // $folderPath = "../flutter/images/";

    // $image_parts = explode(";base64,", $img);
    // $image_type_aux = explode("image/", $image_parts[0]);
    // $image_type = $image_type_aux[1];

    // $image_base64 = base64_decode($image_parts[1]);
    // $fileName = uniqid() . '.jpeg';

    // $file = $folderPath . $fileName;
    // file_put_contents($file, $image_base64);
    //     }

    // print_r($fileName);
    // if($newfilename != ''){
    //     $fileName = $newfilename;
    // }

    $insert_land_sql = "INSERT INTO tbl_landtranspo SET 

   
    date_register       = :dateee,
    entity_no           = :entity_no,
    trans_type          = :transtype,
    vehicle_name        = :namee,
    vehicle_no          = :vnumber,
    plate_no            = :plate,
    route               = :routess,
    contact_name        = :cnamee,
    contact_position    = :poss,
    mobile_no           = :mobile,
    telephone_no        = :tel_no,
    email               = :email,
    photo              = :photo
    
    ";

    $land_data = $con->prepare($insert_land_sql);
    $land_data->execute([

        ':entity_no'    => $entity_no,
        ':dateee'       => $date_register,
        ':transtype'    => $transpo,
        ':namee'        => $vehicle_name,
        ':vnumber'      => $vehicle_no,
        ':plate'        => $plate_no,
        ':routess'      => $route,
        ':cnamee'       => $contact_name,
        ':poss'         => $contact_position,
        ':mobile'       => $mobile_no,
        ':tel_no'       => $tel_no,
        ':email'        => $email_address,
        ':photo'         => $fileName

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
        ':type'             => 'LAND TRANSPORTATION',
        ':status'           => 'ACTIVE'

    ]);

    // $entity_data = $con->prepare($insert_entity_sql);
    // $entity_data->execute([

    // ':entity_no'         => $entity_no,











    $alert_msg .= ' 
    <div class="new-alert new-alert-success alert-dismissible">
        <i class="icon fa fa-success"></i>
        Data Inserted
    </div>  
      ';

    $btn_enabled = 'disabled';
    $btnNew = 'enabled';
    $btnPrint = 'enabled';


    //echo print_r($firstname);


}
