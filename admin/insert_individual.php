<?php

include ('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

$alert_msg = '';
$alert_msg1 = '';

    
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
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $contact_no = $_POST['contact_no'];
    $barangay = $_POST['barangay'];
    $email_address = $_POST['email_address'];
    $photo = $_POST['myFiles'];
    
    //insert to tbl_entity 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = 'INDIVIDUAL';
    $status = 'ACTIVE';

    //for photo
    $currentDir = getcwd();
    $uploadDirectory = "../flutter/images/";
    $errors = [];

    $fileExtensions = ['jpg'];

    $fileName = $_FILES['myFile']['name'];
    $fileSize = $_FILES['myFile']['size'];
    $fileTmpName = $_FILES['myFile']['tmp_name'];
    $fileType = $_FILES['myFile']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFile']['name']);
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = $uploadDirectory . basename($fileName);

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed.";
    }
    if (empty($errors)) {
        $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }


    $insert_individual_sql = "INSERT INTO tbl_individual SET 

    entity_no        = :entity_no,
    date_register    = :date_register,
    firstname        = :firstname,
    middlename       = :middlename,
    lastname         = :lastname,
    contact_no       = :contact_no,
    email_address    = :email_address,
    gender           = :gender,
    birthdate        = :birthdate,
    age              = :age,
    street           = :street,
    barangay         = :barangay,
    city             = :city,
    province         = :province,   
    photo            = :photo";
    
    
    $individual_data = $con->prepare($insert_individual_sql);
    $individual_data->execute([

    ':entity_no'         => $entity_no,
    ':date_register'     => $date_register,
    ':firstname'         => $firstname,
    ':middlename'        => $middlename,
    ':lastname'          => $lastname,
    ':age'               => $age,
    ':gender'            => $gender,
    ':contact_no'        => $contact_no,
    ':email_address'     => $email_address,
    ':barangay'          => $barangay,
    ':birthdate'         => $birthdate,
    ':street'            => $street,
    ':city'              => $city,
    ':province'          => $province,
    ':photo'             => $fileName

]);

    // $insert_entity_sql = "INSERT INTO tbl_entity SET 
    // entity_no           = :entity_no,
    // username            = :username,
    // password            = :password,
    // type                = :type,
    // status              = :status";

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
