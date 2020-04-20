<?php


if($_SERVER["REQUEST_METHOD"] == "GET"){
    require 'db-config.php';
    showInfo();
 }else{
     echo "Oops! We're sorry! You do not have access to this option!";
 }

function showInfo(){
    global $con;

$imageUrl = "http://34.92.117.58/sccdrrmo/userimage/";

$username = $_GET['username'];

//fetch user from database
$get_settings_sql = "SELECT * FROM tbl_settings";
$settings_data = $con->prepare($get_settings_sql);
$settings_data->execute();
while ($result = $settings_data->fetch(PDO::FETCH_ASSOC)) {

    $smart = $result['smart'];
    $globe = $result['globe'];
    $text = $result['text_gateway'];
   
}



//     $userInfo = [
//         'userInfo' => array(
//                 'UserID' => $userID
//         )
//   ];

    $userInfo = array(
        'settings' => array (
             array(
                 'smart'           => $smart,
                 'globe'            => $globe,
                 'text'             => $text
                
               )
                            )
            );
            
    echo json_encode($userInfo);
    die();

        }

?>



