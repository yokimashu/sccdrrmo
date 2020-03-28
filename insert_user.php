
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
    $mobileNumber = $_POST['contactno'];
    $registered = date("m/d/Y");
 
    echo "<pre>";
print_r($_POST);
echo "</pre>";

$hashed_password  = password_hash($userpass, PASSWORD_DEFAULT);

   
$insert_users_sql = "INSERT INTO tbl_users SET
username            = :username,
fullname            = :fullname,
email               = :email,
password            = :password,
birthdate           = :bday,
mobileno            = :mobileno,
gender              = :gender,
account_type        = '2',
created_at          = :created";

$users_data = $con->prepare($insert_users_sql);
$users_data->execute([
':username'         => $username,
':fullname'         => $fullName,
':email'            => $email,
':password'         => $hashed_password,
':bday'             => $birthdate,
':mobileno'         => $mobileNumber,
':gender'           => $gender,
':created'          => $registered

]);

// if($con->query($sql)){
//     $_SESSION['success'] = "<i class='icon fa fa-check'></i>Registered Successfully";
// }else{
//     $_SESSION['error'] = $con->error;
// }else if{
//     $_SESSION['error'] = 'Fill up add form first';
// }

}

header('location: index.php');






?>

