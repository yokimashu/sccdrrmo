<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

    //  echo "<pre>";
    //  print_r($_GET);
    //  echo "</pre>";

$email = $_GET['emailAddress'];

//fetch user from database
$get_user_sql = "SELECT * FROM users where email = :email";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':email' => $email]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $userID = $result['id'];
    $fullName= $result['fullname'];
    $email = $result['email'];
    $mobileno = $result['mobileno'];
}

    $userInfo = array(
       'userInfo' => [
                        'UserID'        => $userID,
                        'Fullname'      => $fullName,
                        'Email'         => $email,
                        'MobileNumber'  => $mobileno
      
    ]
);

    echo json_encode($userInfo);

?>



