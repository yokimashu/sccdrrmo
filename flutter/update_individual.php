<?php

include "dbconfig.php";

$entity_no = $_POST["entity_no"];
$firstname = $_POST["firstname"];
$middlename = $_POST["middlename"];
$lastname = $_POST["lastname"];
$fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
$mobileno = $_POST["mobile_no"];
$telephoneno = $_POST["telephone_no"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$birthdate = date("Y-m-d", strtotime($_POST["birthdate"]));
$street = $_POST["street"];
$barangay = $_POST["barangay"];
$city = $_POST["city"];
$province = $_POST["province"];
$oldPhoto = $_POST["oldPhoto"];
$photo = $_FILES["photo"]["name"];

if ($photo == null) {

    $sql_statement = "UPDATE tbl_individual SET 

    fullname            = :fullname,
    firstname           = :firstname,
    middlename          = :middlename,
    lastname            = :lastname,
    gender              = :gender,
    birthdate           = :birthdate,
    street              = :street,
    barangay            = :barangay,
    city                = :city,
    province            = :province,
    mobile_no           = :mobile_no,
    telephone_no        = :telephone_no,
    email               = :email

    WHERE entity_no     = :entity_no

";

    $sql_data = $con->prepare($sql_statement);
    $sql_data->execute([

        ':fullname'         => $fullname,
        ':firstname'        => $firstname,
        ':middlename'       => $middlename,
        ':lastname'         => $lastname,
        ':gender'           => $gender,
        ':birthdate'        => $birthdate,
        ':street'           => $street,
        ':barangay'         => $barangay,
        ':city'             => $city,
        ':province'         => $province,
        ':mobile_no'        => $mobileno,
        ':telephone_no'     => $telephoneno,
        ':email'            => $email,
        ':entity_no'        => $entity_no

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

    $sql_statement = "UPDATE tbl_individual SET 

    fullname            = :fullname,
    firstname           = :firstname,
    middlename          = :middlename,
    lastname            = :lastname,
    gender              = :gender,
    birthdate           = :birthdate,
    street              = :street,
    barangay            = :barangay,
    city                = :city,
    province            = :province,
    mobile_no           = :mobile_no,
    telephone_no        = :telephone_no,
    email               = :email,
    photo               = :photo

    WHERE entity_no     = :entity_no

";

    $sql_data = $con->prepare($sql_statement);
    $sql_data->execute([

        ':fullname'         => $fullname,
        ':firstname'        => $firstname,
        ':middlename'       => $middlename,
        ':lastname'         => $lastname,
        ':gender'           => $gender,
        ':birthdate'        => $birthdate,
        ':street'           => $street,
        ':barangay'         => $barangay,
        ':city'             => $city,
        ':province'         => $province,
        ':mobile_no'        => $mobileno,
        ':telephone_no'     => $telephoneno,
        ':email'            => $email,
        ':photo'            => $newfilename,
        ':entity_no'        => $entity_no

    ]);

    echo json_encode($newfilename);
}
