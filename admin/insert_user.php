
<?php



if(isset($_POST['add'])){
    echo "<pre>";
    print_r("hello");
    echo "</pre>";
// $user_exist = "SELECT user_id from user where username = :uname";
// $user_data = $con->prepare($user_exist);
// $user_data->execute([':uname' => $_POST['username']]);
// while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
// if($result == 0){
$current_date =  date("Y-m-d H:i:s");
$hashed_password  = password_hash($_POST['upass'], PASSWORD_DEFAULT);
$create_user = "INSERT INTO user SET username = :uname,userpass = :upass, 
                fullname=:fname,email=:email,gender=:gender,contact_no=:cnumber,
                birthdate=:bdate,account_type=:ctype,create_date:cdate,status=:status";
$insert = $con->prepare($create_user);
$insert->execute([  ':uname' => $_POST['uname'],
                    ':upass' =>  $hashed_password,
                    ':fname' => $_POST['fullname'],
                    ':gender' => $_POST['gender'],
                    ':cnumber' => $_POST['gender'],
                    ':bdate' => $_POST['birthdate'],
                    ':ctype' => 'User',
                    'cdate' =>$current_date,
                    ':status' => 'PENDING',
                    ':email' => $_POST['email']]);
// }


}








?>