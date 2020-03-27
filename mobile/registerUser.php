<?php

include ('db-config.php');
//include('import_pdf.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$alert_msg = '';
$alert_msg1 = '';

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
        created_at           = :created";

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

    // $alert_msg .= ' 
    //       <div class="new-alert new-alert-success alert-dismissible">
    //           <i class="icon fa fa-success"></i>
    //           Data Inserted
    //       </div>     
    //   ';
    echo "Register Successful!"
    // $btnStatus = 'disabled';
    // $btnNew = 'enabled';
    


?>