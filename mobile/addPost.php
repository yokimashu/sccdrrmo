<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

     echo "<pre>";
     print_r($_GET);
     echo "</pre>";

// $content = $_POST['Content_Type'];
$type = $_POST['Type'];
$severity = $_POST['topicSeverity'];
$title = $_POST['topicTitle'];
$image = $_POST['topicImage'];
$locationID = $_POST['topicLocationID'];
$locationName = $_POST['topicLocationName'];
$locationAddress = $_POST['topicLocationAddress'];
$postedBy = $_POST['topicPostedBy'];
$created = $_POST['topicDateAndTimePosted'];

$insert_users_sql = "INSERT INTO tbl_incident SET
type                = :type,
severity            = :severity,
topic               = :topic,
image               = :image,
location_id         = :locationID,
location_name       = :locationName,
location_address    = :locationAddress,
reported_by         = :reportedBy,
created_at          = :createdAt";

$users_data = $con->prepare($insert_users_sql);
$users_data->execute([
':type'             => $type,
':severity'         => $severity,
':topic'            => $title,
':image'            => $image,
':locationID'       => $locationID,
':locationName'     => $locationName,
':locationAddress'  => $locationAddress,
':reportedBy'       => $postedBy,
':createdAt'        => $created

]);

?>



