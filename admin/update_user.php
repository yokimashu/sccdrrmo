<?php
 include('../config/db_config.php');


if(isset($_POST['update'])){

$id = $_POST['user_id'];
$username = $_POST['username'];
// $userpass = $_POST['userpass'];
$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
$address = $_POST['address'];
$email = $_POST['email'];
$mobileNumber = $_POST['contactno'];
$account_type = $_POST['user_type'];


$sql2 = "UPDATE tbl_users SET 
username            = '$username',
fullname            = '$fullname' ,
email               = '$email',
birthdate           = '$birthdate',
address             = '$address',
mobileno            = '$mobileNumber',
gender              = '$gender',
account_type        = '$account_type'
 WHERE               id = '$id'";

if ($con->query($sql2))

    {
     $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>You have successfully updated the user.
        </div>     
    ';
    // $_SESSION['success'] = "<i class='icon fa fa-check'></i>Registered Successfully.";
   


}
else {
    $alert_msg .= ' 
    <div class="alert alert-danger alert-dismissible>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="icon fa fa-warning"></i>
        Update is unsuccessful!
    </div>     
';
}


}
?>