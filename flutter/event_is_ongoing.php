<?php

include "dbconfig.php";

// check if event is on going

$event = "SELECT * FROM tbl_mobile_ui ORDER BY objid ASC";
$event_data = $con->prepare($event);
$event_data->execute();
$results = $event_data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>