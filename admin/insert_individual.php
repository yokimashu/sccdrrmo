<?php

include ('../config/db_config.php');

date_default_timezone_set('Asia/Manila');


    
if (isset($_POST['insert_individual'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    //insert to tbl_individual
    $entity_no = $_POST['entity_no'];
    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $fullname = $_POST['firstname'] .' ' . $_POST['middlename'] . '.' . ' ' . $_POST['lastname'];
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
    // $photo = $_POST['myFiles'];
    
    //insert to tbl_entity 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = 'INDIVIDUAL';
    $status = 'ACTIVE';

    // //for photo
    // $currentDir = getcwd();
    // $uploadDirectory = "../flutter/images/";
    // $errors = [];

    // $fileExtensions = ['jpg'];

    // $fileName = $_FILES['myFile']['name'];
    // $fileSize = $_FILES['myFile']['size'];
    // $fileTmpName = $_FILES['myFile']['tmp_name'];
    // $fileType = $_FILES['myFile']['type'];
    // $target_file = $uploadDirectory . basename($_FILES['myFile']['name']);
    // $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // // $fileExtension = strtolower(end(explode('.',$fileName)));
    // $uploadPath = $uploadDirectory . basename($fileName);

    // if (!in_array($fileExtension, $fileExtensions)) {
    //     $errors[] = "This file extension is not allowed.";
    // }
    // if (empty($errors)) {
    //     $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);
    // }


    $insert_individual_sql = "INSERT INTO tbl_individual SET 

    entity_no        = :entity_no,
    username         = :username,
    date_register    = :date_register,
    firstname        = :firstname,
    middlename       = :middlename,
    lastname         = :lastname,
    fullname         = :fullname,
    -- mobile_no        = :mobile_no,
    -- telephone_no     = :telephone_no,
    -- email            = :email,
    gender           = :gender,
    birthdate        = :birthdate,
    age              = :age,
    street           = :street,
    -- barangay         = :barangay,
    city             = :city,
    province         = :province   
    -- photo            = :photo
    
    ";
    
    
    $individual_data = $con->prepare($insert_individual_sql);
    $individual_data->execute([

    ':entity_no'         => $entity_no,
    ':username'          => $username,
    ':date_register'     => $date_register,
    ':firstname'         => $firstname,
    ':middlename'        => $middlename,
    ':lastname'          => $lastname,
    ':fullname'          => $fullname,
    ':age'               => $age,
    ':gender'            => $gender,
    // ':mobile_no'         => $mobile_no,
    // ':telephone_no'      => $telephone_no,
    // ':email'             => $email,
    // ':barangay'          => $barangay,
    ':birthdate'         => $birthdate,
    ':street'            => $street,
    ':city'              => $city,
    ':province'          => $province
    // ':photo'             => $fileName

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

':entity_no'         => $entity_no,
':username'     => $username,
':password'         => $entity_no,
':type'         => 'INDIVIDUAL',
':status'        => 'ACTIVE'

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

      $btnStatus = 'disabled';
      $btnNew = 'enabled';
      $btnPrint = 'enabled';
  

      //echo print_r($firstname);
      header("location: list_individual.php");

}

?>
