<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

    //  echo "<pre>";
    //  print_r($_GET);
    //  echo "</pre>";
$imageUrl = "http://35.241.87.123/sccdrrmo/userimage/";

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
    $birthdate = $result['birthdate'];
    $mobileno = $result['mobileno'];
    $address = $result['address'];
    $image = $imageUrl . $result['photo'];
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
                 'Firstname'        => $firstName,
                 'Middlename'       => $middleName,
                 'Lastname'         => $lastName,
                 'Birthdate'        => $birthdate,
                 'Email'            => $email,
                 'MobileNumber'     => $mobileno,
                 'Address'          => $address,
                 'Photo'            => $image

                   )
                            )
            );
            
    echo json_encode($userInfo);

?>



