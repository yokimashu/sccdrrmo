<?php

include "dbconfig.php";

$feed_id = $_POST["feed_id"];
$comment = $_POST["comment"];
$entity_no = $_POST["entity_no"];

$status = 'new';


date_default_timezone_set('Asia/manila');

$timestamp = date('Y-m-d G:i:s');




$sql5 = "INSERT INTO tbl_comment SET
        feed_id             = :feed_id,
        cmt_entityID        = :cmt_entityID,
        comment             = :comment,
        date                 = :date,
        status              = :status
      
        ";

$sql_data5 = $con->prepare($sql5);
$sql_data5->execute([
    ':feed_id'          => $feed_id,
    ':cmt_entityID'     => $entity_no,
    ':comment'          => $comment,
    ':date'             => $timestamp,
    ':status'           => $status


]);




echo json_encode('Success');
