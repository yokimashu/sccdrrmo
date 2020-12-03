<?php

include "dbconfig.php";

$entity_no = $_POST["entity_no"];
$org_name = $_POST["org_name"];
$org_type = $_POST["org_type"];
$nature = $_POST["business_nature"];
$contact_person = $_POST["contact_name"];
$contact_position = $_POST["contact_position"];
$mobile_no = $_POST["mobile_no"];
$telephone_no = $_POST["telephone_no"];
$street = $_POST["street"];
$barangay = $_POST["barangay"];
$city = $_POST["city"];
$province = $_POST["province"];
$email_address = $_POST["email"];
$oldPhoto = $_POST["oldPhoto"];
$photo = $_FILES["photo"]["name"];

if ($photo == null) {

    $sql_statement = "UPDATE tbl_juridical SET 


       
        org_name            = :org_name,
        org_type            = :org_type,
        business_nature     = :nature,
        street              = :street,
        barangay            = :barangay,
        city                = :city,
        province            = :province,
        contact_name        = :contact_name,
        contact_position    = :position,
        mobile_no           = :mobile_no,
        telephone_no        = :telephone_no,
        email               = :email_address

    WHERE entity_no     = :entity_no

";

    $sql_data = $con->prepare($sql_statement);
    $sql_data->execute([


        ':org_name'          => $org_name,
        ':org_type'          => $org_type,
        ':nature'            => $nature,
        ':street'            => $street,
        ':barangay'          => $barangay,
        ':city'              => $city,
        ':province'          => $province,
        ':contact_name'      => $contact_person,
        ':position'          => $contact_position,
        ':mobile_no'         => $mobile_no,
        ':telephone_no'      => $telephone_no,
        ':email_address'     => $email_address,

        ':entity_no'         => $entity_no

    ]);

    echo json_encode('Success');
} else {

    // --- delete image in the file directory
    unlink('images/' . $oldPhoto);


    // --- photo location and generate unique photo name
    $currentDir = getcwd();
    $path = "images/";
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $temp = explode('.', $_FILES['photo']['name']);
    $newfilename = round(microtime(true)) . $firstname . '.' . end($temp);
    $uploadPath = $path . $newfilename;

    // --- uplaod photo
    move_uploaded_file($fileTmpName, $uploadPath);

    $sql_statement = "UPDATE tbl_juridical SET 

        org_name            = :org_name,
        org_type            = :org_type,
        business_nature     = :nature,
        street              = :street,
        barangay            = :barangay,
        city                = :city,
        province            = :province,
        contact_name        = :contact_name,
        contact_position    = :position,
        mobile_no           = :mobile_no,
        telephone_no        = :telephone_no,
        email               = :email_address,
        photo               = :photo

    WHERE entity_no     = :entity_no

";

    $sql_data = $con->prepare($sql_statement);
    $sql_data->execute([

        ':org_name'          => $org_name,
        ':org_type'          => $org_type,
        ':nature'            => $nature,
        ':street'            => $street,
        ':barangay'          => $barangay,
        ':city'              => $city,
        ':province'          => $province,
        ':contact_name'      => $contact_person,
        ':position'          => $contact_position,
        ':mobile_no'         => $mobile_no,
        ':telephone_no'      => $telephone_no,
        ':email_address'     => $email_address,
        ':photo'             => $newfilename,

        ':entity_no'         => $entity_no

    ]);

    echo json_encode($newfilename);
}
