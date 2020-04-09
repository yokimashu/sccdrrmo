<?php

include ('..config/db_config.php');

if (isset($_POST['send'])) {


$token = array();

$get_token_sql = "SELECT token FROM tbl_users";
$get_token_data = $con->prepare($get_token_sql);
$get_token_data->execute();
while ($result = $get_token_data->fetch(PDO::FETCH_ASSOC)) {
    $token[]=$result['token'];
}

    $url = "https://fcm.googleapis.com/fcm/send";
    //$token              = "your device token";
    $serverKey          = 'AAAAPN2sEA0:APA91bFJNXG0TYDBo51vJbCJh2bMEL_uO3KJ5qGhzkW9V1w32wEz5HgQLRBmP2nJwAz1-_rS3g4xdQQKRWHNmF00fqShvDNRwEnNP5GTMLAkY23ABb6uGdPjtm2P5Yqjrc_4bObc_J7G';
    $message            = $_POST['message'];
    $title              = $_POST['title'];
    $notification       = array('title' =>$title , 'body' => $message, 'sound' => 'default', 'badge' => '1');
    $arrayToSend        = array('registration_ids' => $token, 'notification' => $notification,'priority'=>'high');
    $json               = json_encode($arrayToSend);
    $headers            = array();
    $headers[]          = 'Content-Type: application/json';
    $headers[]          = 'Authorization: key='. $serverKey;
    $ch                 = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);

}

?>