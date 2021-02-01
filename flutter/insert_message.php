<?php

include "dbconfig.php";



$notif_objid = $_POST["notif_objid"];
$message = $_POST["message"];
$sender = $_POST["entity_no"];
$datetimenow = $_POST["datetimenow"];

$newdate = date("Y-m-d", strtotime($datetimenow));
$newtime = date("H:i:s", strtotime($datetimenow));


    // - - - INSERT  Entity - - - / /
    $insert_entity_sql = "INSERT INTO tbl_message SET 

        notif_objid     = :notif_objid,
        message         = :message,
        date            = :date,
        time            = :time,
        sender          = :sender
 
    ";

    $sql_data = $con->prepare($insert_entity_sql);
    $sql_data->execute([

        ':notif_objid'    => $notif_objid,  
        ':message'        => $message,
        ':date'           => $newdate,  
        ':time'           => $newtime,  
        ':sender'         => $sender


    ]);

    echo json_encode('Success');

    ?>
