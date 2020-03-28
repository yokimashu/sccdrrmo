
<?php
session_start();
include('config/db_config.php');

if(isset($_POST['add'])){
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $datenow = date("m/d/Y");
 
$hashed_password  = password_hash($userpass, PASSWORD_DEFAULT);

$sql = "INSERT INTO tbl_users (
    username,
    userpass,
    fullname,
    email,
    gender,
    mobileno,
    birthdate,
    account_type,
    createdat,
    status
    
    ) VALUES (
        
    '$username',
    '$hashed_password',
    '$fullname',
    '$email',
    '$gender',
    '$contactno',
    '$birthdate',
    '2',
    '$datenow',
    'PENDING'
    
    )";

if($con->query($sql)){
    $_SESSION['success'] = "<i class='icon fa fa-check'></i>New User added successfully";
}
else{
    $_SESSION['error'] = $con->error;
}
}
else{
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: index.php');






?>

