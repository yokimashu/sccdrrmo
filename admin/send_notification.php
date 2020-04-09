<?php

include ('../config/db_config.php');


if (isset($_POST['save'])) {

 echo "<pre>";
    print_r($_POST);
    echo "</pre>";

// $message            = $_POST['message'];
// $title              = $_POST['title'];
// $path_to_fcm        = 'https://fcm.googleapis.com/fmc/send';
// $server_key         = 'AAAAPN2sEA0:APA91bFJNXG0TYDBo51vJbCJh2bMEL_uO3KJ5qGhzkW9V1w32wEz5HgQLRBmP2nJwAz1-_rS3g4xdQQKRWHNmF00fqShvDNRwEnNP5GTMLAkY23ABb6uGdPjtm2P5Yqjrc_4bObc_J7G';
// // $sql                = "SELECT token from tbl_users";
// // $result             = mysqli_query($con,$sql);
// // $row                = mysqli_fetch_row($result);

$get_token_sql = "SELECT token FROM tbl_users";
$get_token_data = $con->prepare($get_token_sql);
$get_token_data->execute();
while ($result = $get_token_data->fetch(PDO::FETCH_ASSOC)) {
  $token= $result['token'];



// echo $sql;
// echo $token;

// $headers            = array(
//                      'Authorization:key=' .$server_key,
//                      'Content-Type:application/json'
//                     );

// $fiels              = array('to'=>$token,
//                             'notification'=>array('title'=>$title,'body'=>$message));

// $payload            = json_encode($fields);

// $curl_session       = curl_init();

// curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
// curl_setopt($curl_session, CURLOPT_POST, true);
// curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_v4);
// curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

// $result = curl_exec($curl_session);
// mysqli_close($con);

// }

    $url = "https://fcm.googleapis.com/fcm/send";
    //$token              = "your device token";
    $serverKey          = 'AAAAPN2sEA0:APA91bFJNXG0TYDBo51vJbCJh2bMEL_uO3KJ5qGhzkW9V1w32wEz5HgQLRBmP2nJwAz1-_rS3g4xdQQKRWHNmF00fqShvDNRwEnNP5GTMLAkY23ABb6uGdPjtm2P5Yqjrc_4bObc_J7G';
    $message            = $_POST['message'];
    $title              = $_POST['title'];
    $notification = array('title' =>$title , 'body' => $message, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
}
}

?>