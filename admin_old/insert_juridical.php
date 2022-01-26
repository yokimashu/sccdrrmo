<?php

date_default_timezone_set('Asia/Manila');
//include('import_pdf.php');

$alert_msg = '';


if (isset($_POST['insert_juridical'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    //for tbl_juridical
    $entity_no = $_POST['entity_no'];
    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $org_type = $_POST['type'];
    $org_name = $_POST['org_name'];
    $nature = $_POST['nature'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $contact_person = $_POST['contact_person'];
    $contact_position = $_POST['contact_position'];
    $mobile_no = $_POST['mobile_no'];
    $telephone_no = $_POST['telephone_no'];
    $email_address = $_POST['email'];
    $img = $_POST['image'];
    //for table entity
    $username = $_POST['username'];
    $hashed_password  = password_hash($entity_no, PASSWORD_DEFAULT);
    // $type = 'JURIDICAL';
    // $status = 'ACTIVE';
  

        $folderPath = "../flutter/images/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpg';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);


    $insert_juridical_sql = "INSERT INTO tbl_juridical SET 

        entity_no           = :entity_no,
        date_register       = :date_register,
        org_name            = :org_name,
        org_type            = :org_type,
        business_nature     = :nature,
        street              = :address,
        barangay            = :barangay,
        city                = :city,
        province            = :province,
        contact_name        = :contact_name,
        contact_position    = :position,
        mobile_no           = :mobile_no,
        telephone_no        = :telephone_no,
        email               = :email_address,
        photo               = :photo 
        ";

    $juridical_data = $con->prepare($insert_juridical_sql);
    $juridical_data->execute([

        ':entity_no'         => $entity_no,
        ':date_register'     => $date_register,
        ':org_name'          => $org_name,
        ':org_type'          => $org_type,
        ':nature'            => $nature,
        ':address'           => $street,
        ':barangay'          => $barangay,
        ':city'              => $city,
        ':province'          => $province,
        ':contact_name'      => $contact_person,
        ':position'          => $contact_position,
        ':mobile_no'         => $mobile_no,
        ':telephone_no'      => $telephone_no,
        ':email_address'     => $email_address,
        ':photo'            =>  $fileName

    ]);

    $insert_entity_sql = "INSERT INTO tbl_entity SET 
    entity_no           = :entity_no,
    username            = :username,
    password            = :password,
    type                = :type,
    status              = :status";


    $entity_data = $con->prepare($insert_entity_sql);
    $entity_data->execute([

        ':entity_no'        => $entity_no,
        ':username'         => $username,
        ':password'         => $hashed_password,
        ':type'             => 'JURIDICAL',
        ':status'           => 'ACTIVE'

    ]);

    $alert_msg .= ' 
<div class="new-alert new-alert-success alert-dismissible">
    <i class="icon fa fa-success"></i>
    Data Inserted
</div>  
  ';

    $btn_enabled = 'disabled';
    $btnNew = 'enabled';
    $btnPrint = 'enabled';

    // echo print_r($firstname);
    //header("location: list_juridical.php");
}
