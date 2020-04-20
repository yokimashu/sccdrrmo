
<?php





if(isset($_POST['add'])){
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname   = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['contactno'];
    $registered = date("Y/m/d");
    $fileName = '';
    $newfilename = '';
    $verification = rand(100000,999999);
    if ($_FILES["myFiles"]["error"] == 4)
        {  
        $fileName = 'avatar5.png';
        }else
        {
     $fileName = $_FILES['myFiles']['name'];
     $temp = explode(".", $_FILES["myFiles"]["name"]);
     $newfilename = round(microtime(true)) . '.' . end($temp);
        }
      
       
$hashed_password  = password_hash($userpass, PASSWORD_DEFAULT);

   

$check_username = "SELECT * from tbl_users where username = '$username'";
$sql =$con->query($check_username);
if($sql ->rowCount() > 0){

$alert_msg .= ' 
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="icon fa fa-warning"></i>Username Already Exist.
</div>     
';  
}else{
$sql2 = "INSERT INTO tbl_users SET
username            = '$username',
firstname           = '$firstname' ,
middlename          = '$middlename', 
lastname            = '$lastname',
email               = '$email',
password            = '$hashed_password',
birthdate           = '$birthdate',
address             = '$address',
mobileno            = '$mobileNumber',
gender              = '$gender',
account_type        = '2',
created_at          = '$registered',
verification_code   =  '$verification',
status              = 'PENDING',";
if($newfilename == '')
{
$sql2.="photo   =  '$fileName'";
}else
{
$sql2.="photo   =  '$newfilename'"; 
}
if ($con->query($sql2))

    {
        //send email

        include ('email_user.php');

        
        // $to = $email;
        // $subject = "Email Verification";
        // $message ="sample email verification";
        // $headers = "From: jonardmondero@gmail.com";
        // $headers.=  'MIME-Version: 1.0' . "\r\n"; 
        // $headers.='Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

        // mail($to,$subject,$message,$headers);


    
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

    $currentDir = getcwd();
    $uploadDirectory = "userimage/";
    

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg'];

    // $fileName = $_FILES['myFiles']['name'];
    $fileSize = $_FILES['myFiles']['size'];
    $fileTmpName = $_FILES['myFiles']['tmp_name'];
    $fileType = $_FILES['myFiles']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFiles']['name']);
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $fileExtension = strtolower(end(explode('.',$fileName)));

   

    $uploadPath = $uploadDirectory .  $newfilename;
        // echo "<pre>";
        // echo print_r($uploadPath);
        // echo "</pre";
    

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed.";
    }
    if (empty($errors)) {
        $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }

//         if ($dipUpload) {
//             $alert_msg .= ' 
//        <div class="table-bordered">
//            <i class="icon fa fa-success"></i>
//            File has been uploaded
//        </div>     
//    ';
//             // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';


//         } else {
//             $alert_msg .= ' 
//        <div class="alert alert-warning alert-dismissible"">
//            <i class="icon fa fa-warning"></i>
//            An Error Occured;
//        </div>     
//    ';

//         }



}


if(isset($_POST['update'])){
    $account_type = $_POST['user_type'];
    $account_type_value ;
if($account_type == "Administrator"){
    $account_type_value = 1;
}
if($account_type == "User"){
    $account_type_value = 2;
}
if($account_type == "Mobile"){
    $account_type_value = 3;
}
    $id = $_POST['user_id_edit'];
    $username = $_POST['username'];
    // $userpass = $_POST['userpass'];
    
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['contactno'];
    $fileName = '';
    $newfilename = '';  
     $fileName = $_FILES['myFiles']['name'];
     $temp = explode(".", $_FILES["myFiles"]["name"]);
     $newfilename = round(microtime(true)) . '.' . end($temp);

    $sql2 = "UPDATE tbl_users SET 
    username            = '$username',
    firstname           = '$firstname',
    middlename          = '$middlename',
    lastname            = '$lastname',
    email               = '$email',
    birthdate           = '$birthdate',
    address             = '$address',
    mobileno            = '$mobileNumber',
    gender              = '$gender',
    account_type        = $account_type_value";

    if($newfilename != '')
    {
        $sql2.=",photo = '$newfilename'";
    }
    $sql2.= " WHERE  id    = $id";
    
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


    $currentDir = getcwd();
    $uploadDirectory = "../userimage/";
    

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg'];

    // $fileName = $_FILES['myFiles']['name'];
    $fileSize = $_FILES['myFiles']['size'];
    $fileTmpName = $_FILES['myFiles']['tmp_name'];
    $fileType = $_FILES['myFiles']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFiles']['name']);
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $fileExtension = strtolower(end(explode('.',$fileName)));

   

    $uploadPath = $uploadDirectory .  $newfilename;
        // echo "<pre>";
        // echo print_r($uploadPath);
        // echo "</pre";
    

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed.";
    }
    if (empty($errors)) {
        $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }




  
    }


?>

