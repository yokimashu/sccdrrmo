
<?php



if(isset($_POST['add'])){
    
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    // $birthdate = date_format($_POST['birthdate'] ,"Y-m-d");
    $birthdate =$_POST['birthdate'] ;
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
created_at          = :created,
status              = 'PENDING'";


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

// $_SESSION['check'] = "<i class='icon'></i>The username is already taken."; 

$alert_msg .= ' 
<div class="alert alert-danger alert-dismissible>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="icon fa fa-warning"></i>
Username already exist!
</div>   
';  
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
       

        $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>Registered Successfully.
        </div>     
    ';
    // $_SESSION['success'] = "<i class='icon fa fa-check'></i>Registered Successfully.";
   


}
else {
    $alert_msg .= ' 
    <div class="alert alert-danger alert-dismissible>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="icon fa fa-warning"></i>
        Registration is unsuccessful!
    </div>     
';
}


}
// header('location: index.php');
}








?>

