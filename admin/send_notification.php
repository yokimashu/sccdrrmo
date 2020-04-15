<?php

include ('../config/db_config.php');

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
    $serverKey          = 'AAAAuF1uNFM:APA91bGXH4SXapwXpI6qxaapsX_Me9M5573saXnFxFpW4tZD_M3xV_pg4tYAxvHzovPkqDr0u5pnlZPHvZLPdlsZoCKp6wnUXpWEW5EhG7xM4byW8PTAxfsCedSWvXFy-lEQvonU-FVN';
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