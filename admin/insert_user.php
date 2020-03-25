
<?php

include ('../config/db_config.php');

if(isset($_POST['uname'])){
$user_exist = "SELECT userID from users where username = :uname";
$user_data = $con->prepare($user_exist);
$user_data->execute([':uname' => $_POST['uname']]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
if($result == 0){
$hashed_password  = password_hash($_POST['upass'], PASSWORD_DEFAULT);
$create_user = "INSERT INTO users SET username = :uname,upass = :upass, userType=:utype";
$insert = $con->prepare($create_user);
$insert->execute([  ':uname' => $_POST['uname'],
                    ':upass' =>  $hashed_password,
                    ':utype' => 'User']);
}


}



}




?>