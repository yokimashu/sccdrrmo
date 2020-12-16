<?php

include "dbconfig.php";


$datetime = $_POST["datetime"];
$entityNo = $_POST["entity_no"];
$traceNo = $_POST["trace_no"];

$newdate = date("Y-m-d", strtotime($datetime));
$newtime = date("H:i:s", strtotime($datetime));


// - - - INSERT  History - - - / /
$insert_history_sql = "INSERT INTO tbl_tracehistory SET 

        date           = :date,
        time           = :time,
        entity_no      = :entity_no,
        trace_no       = :trace_no
      
 
    ";

$history_data = $con->prepare($insert_history_sql);
$history_data->execute([

    ':date'          => $newdate,
    ':time'          => $newtime,
    ':entity_no'     => $entityNo,
    ':trace_no'      => $traceNo



]);

echo json_encode('Success');
