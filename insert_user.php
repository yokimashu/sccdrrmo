
<?php

include('config/db_config.php');

if(isset($_POST['add'])){
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $birthdate = date_format($_POST['birthdate'] ,"Y-m-d");
    $email = $_POST['email'];
    $mobileNumber = $_POST['contactno'];
    $registered = date("m/d/Y");
   
    


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


// $sql2 = "INSERT INTO tbl_users SET
// username            = '$username',
// fullname            = ' $fullname' ,
// email               = '$email',
// password            ='$hashed_password' ,
// birthdate           = '$birthdate',
// mobileno            ='$mobileNumber',
// gender              = '$gender',
// account_type        = '2',
// created_at          = '$registered'";
$check_username = "SELECT * from tbl_users where username = '$username'";
$sql =$con->query($check_username);
if($sql ->rowCount() > 0){
$_SESSION['check'] = "<i class='icon'></i>The username is already taken."; 
}else{
$users_data = $con->prepare($insert_users_sql);
// if ($con->query($sql2))
if($users_data->execute([
':username'         => $username,
':fullname'         => $fullname,
':email'            => $email,
':password'         => $hashed_password,
':bday'             => $birthdate,
':mobileno'         => $mobileNumber,
':gender'           => $gender,
':created'          => $registered

]))
    {
       


    $_SESSION['success'] = "<i class='icon fa fa-check'></i>Registered Successfully.";
   


}
else {
    $_SESSION['error'] = $con->error;
}


}

}
header('location: index.php');







?>

