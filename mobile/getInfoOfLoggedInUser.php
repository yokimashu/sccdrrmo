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

    $userInfo = [
       
                        'UserID'        => $userID,
                        'Fullname'      => $fullName,
                        'Email'         => $email,
                        'MobileNumber'  => $mobileno
      
    ];

    echo json_encode(array('userInfo' => $userInfo))."\n";
// echo "hello world!"
//echo sample
<<<<<<< HEAD

=======
//echo connect 
>>>>>>> 8690a1f682be2263130955bfc234be7755d07cee
?>