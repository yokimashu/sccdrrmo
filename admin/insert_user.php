<?php
if(isset($_POST['username'])){
$user_exist = "SELECT userID from users where username = :uname";
$user_data = $con->prepare($user_exist);
$user_data->execute([':uname' => $_POST['username']]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
if(!$result){
$create_user = "INSERT INTO user SET username = :uname,password= :upass,userType=:utype";
$insert = $con->prepare($create_user);
$insert->execute([':uname' => $_POST['username'],
                    ':upass'=>$_POST['upass'],
                    'userType' => $'User']);
}


}



}







?>