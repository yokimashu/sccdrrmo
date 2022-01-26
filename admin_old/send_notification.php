<?php

include ('../config/db_config.php');

if (isset($_POST['send'])) {


$token = array();

// $get_token_sql = "SELECT DISTINCT(token) FROM tbl_entity WHERE token IS NOT NULL";
// $get_token_data = $con->prepare($get_token_sql);
// $get_token_data->execute();
// while ($result = $get_token_data->fetch(PDO::FETCH_ASSOC)) {
//     $token[]=$result['token'];
// }

    $url = "https://fcm.googleapis.com/fcm/send";
    $token              = "cgb8oECoTHqgRtoHP5ROTh:APA91bHEzDntT_hqzplRtn9r_1t0nbLE49G9shx7E5-txo0_1M49Ylwyp7RAWF5OFbvrhvpCdFCRpdajDMrX3KpECzYbY2ii6-duFHUM3V-mUBSrDwmfuHkPKYOYTsSifR39zk3GIBDw";
    $serverKey          = 'AAAAaPnV-84:APA91bEy_yoIL7aaD8Pq6npOFJbTuAr0zoEiOuxs3_W8_2aggA5FiLI5bLMJrVECiVW7G4idgXxHiXvxVMfDk9u2KIRnH62h9Uvy3W41qlGyoFTMr75dTw0tuk3dpv_C9f4SxoTtcT9C';
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