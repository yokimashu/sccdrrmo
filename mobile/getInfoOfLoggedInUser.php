<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

    //  echo "<pre>";
    //  print_r($_GET);
    //  echo "</pre>";

$username = $_GET['username'];

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where username = :username";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':username' => $username]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $userID = $result['id'];
    $firstName = $result['firstname'];
    $middleName = $result['middlename'];
    $lastName = $result['lastname'];
    $email = $result['email'];
    $mobileno = $result['mobileno'];
    $address = $result['address'];
}

$fullName = $firstName . ' ' . $middleName . ' ' . $lastName;

//     $userInfo = [
//         'userInfo' => array(
//                 'UserID' => $userID
//         )
//   ];

    $userInfo = array(
        'userInfo' => array (
             array(
                 'UserID'           => $userID,
                 'Fullname'         => $fullName,
                 'Email'            => $email,
                 'MobileNumber'     => $mobileno,
                 'Address'          => $address

                   )
                            )
            );
            
    echo json_encode($userInfo);

?>



