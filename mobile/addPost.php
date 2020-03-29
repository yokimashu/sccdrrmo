<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

     // echo "<pre>";
     // print_r($_POST);
     // echo "</pre>";

// $content = $_POST['Content_Type'];
$type = $_POST['Type'];
$severity = $_POST['topicSeverity'];
$title = $_POST['topicTitle'];
$image = $_POST['topicImage'];
$latitude= $_POST['latitude'];
$longitude = $_POST['longitude'];
$locationAddress = $_POST['topicLocationAddress'];
$postedBy = $_POST['topicPostedBy'];
$mobileno = $_POST['mobileNo'];
$created = $_POST['topicDateAndTimePosted'];

$insert_users_sql = "INSERT INTO tbl_incident SET
type                = :type,
severity            = :severity,
topic               = :topic,
image               = :image,
latitude            = :latitude,
longitude           = :longitude,
location_address    = :locationAddress,
reported_by         = :reportedBy,
mobileno            = :mobileno,
createdat           = :createdAt,
remarks             = 'NEW REPORT'";

$users_data = $con->prepare($insert_users_sql);
$users_data->execute([
':type'             => $type,
':severity'         => $severity,
':topic'            => $title,
':image'            => $image,
':latitude'         => $latitude,
':longitude'        => $longitude,
':locationAddress'  => $locationAddress,
':reportedBy'       => $postedBy,
':mobileno'         => $mobileno,
':createdAt'        => $created

]);

?>



