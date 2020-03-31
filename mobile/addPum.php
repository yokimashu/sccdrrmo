<?php

include ('db-config.php');
date_default_timezone_set('Asia/Manila');
// session_start();
// $user_id = $_SESSION['id'];

     echo "<pre>";
     print_r($_POST);
     echo "</pre>";

// $content = $_POST['Content_Type'];

$fullName = $_POST['fullName'];
$contactNo = $_POST['contactNo'];
$address = $_POST['address'];
$travel = $_POST['travel'];
$travelHistory = $_POST['travelHistory'];
$symptoms = $_POST['symptoms'];
$postedBy = $_POST['PostedBy'];
$mobileno = $_POST['mobileNo'];
$created = $_POST['topicDateAndTimePosted'];
$date = date('Y-m-d');
$time = date('h:i:s');

$insert_pum_sql = "INSERT INTO tbl_reportpum SET
date                = :date,
time                = :time,
fullname            = :fullname,
contactno           = :contactno,
address             = :address,
travel              = :travel,
travelhistory       = :travelhistory,
symptoms            = :symptoms,
reportedby          = :reportedby,
mobileno            = :mobileno,
createdat           = :createdat,
remarks             = 'NEW REPORT'";

$users_data = $con->prepare($insert_pum_sql);
$users_data->execute([
':date'             => $date,
':time'             => $time,
':fullname'         => $fullName,
':contactno'        => $contactNo,
':address'          => $address,
':travel'           => $travel,
':travelhistory'    => $travelHistory,
':symptoms'         => $symptoms,
':reportedby'       => $postedBy,
':mobileno'         => $mobileno,
':createdat'        => $created


]);

?>




