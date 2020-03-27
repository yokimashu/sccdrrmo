<?php

include ('db-config.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";



    $fullName = $_POST['fullname'];
    $email = $_POST['emailAddress'];
    $password = $_POST['password'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $mobileNumber = $_POST['mobileNumber'];
    $gender = $_POST['gender'];
    $registered = $_POST['dateAndTimeRegistered'];

    $hashed_password  = password_hash($password, PASSWORD_DEFAULT);
   
    $insert_users_sql = "INSERT INTO tbl_users SET
        fullname            = :fullname,
        email               = :email,
        password            = :password,
        birthdate           = :bday,
        mobileno            = :mobileno,
        gender              = :gender,
        account_type        = '3',
        created_at          = :created";

    $users_data = $con->prepare($insert_users_sql);
    $users_data->execute([
        ':fullname'         => $fullName,
        ':email'            => $email,
        ':password'         => $hashed_password,
        ':bday'             => $birthdate,
        ':mobileno'         => $mobileNumber,
        ':gender'           => $gender,
        ':created'          => $registered
        
        ]);

 
    echo "Register Successful!"
   


?>