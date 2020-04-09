<?php

require 'db-config.php';

$message            = $_POST['message'];
$title              = $_POST['title'];
$path_to_fcm        = 'https://fcm.googleapis.com/fmc/send';
$server_key         = 'AIzaSyB7C9GBUm0Z2kfW7OJHz3IoXk0n319gHS8';
$sql                = 'Select fcm_token from tbl_users';
$result             = mysqli_query($con,$sql);
$row                = mysqli_fetch_row($result);
$key                = $row[0];

$headers            = array('to'=>$key,
                            'notification'=>array('title'=>$title,'body'=>$message));

$payload            = json_encode($fields);

$curl_session       = curl_init();

curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
curl_setopt($curl_session, CURLOPT_POST, true);
curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_v4);
curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

$result = curl_exec($curl_session);
mysqli_close($con);
