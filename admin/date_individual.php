<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';



$get_all_history_sql = "Select * FROM
(
    SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
inner join tbl_individual i on i.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'

UNION

SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
inner join tbl_individual i on i.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'
    
UNION

SELECT date, time, t.entity_no, t.trace_no, j.org_name, CONCAT(j.street, ', ', j.barangay) as details, j.mobile_no FROM `tbl_tracehistory` t
inner join tbl_juridical j on j.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'

UNION

SELECT date, time, t.entity_no, t.trace_no, j.org_name, CONCAT(j.street, ', ', j.barangay) as details, j.mobile_no FROM `tbl_tracehistory` t
inner join tbl_juridical j on j.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'

UNION

SELECT date, time, t.entity_no, t.trace_no, l.vehicle_name, l.plate_no, l.mobile_no FROM `tbl_tracehistory` t
inner join tbl_landtranspo l on l.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'
    
UNION

SELECT date, time, t.entity_no, t.trace_no, l.vehicle_name, l.plate_no, l.mobile_no FROM `tbl_tracehistory` t
inner join tbl_landtranspo l on l.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'
    
UNION

SELECT date, time, t.entity_no, t.trace_no, s.vessel_name, s.voyage_no, s.mobile_no FROM `tbl_tracehistory` t
inner join tbl_seatranspo s on s.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'
    
UNION

SELECT date, time, t.entity_no, t.trace_no, s.vessel_name, s.voyage_no, s.mobile_no FROM `tbl_tracehistory` t
inner join tbl_seatranspo s on s.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'
    
) dum 

WHERE fullname NOT IN (Select fullname from tbl_individual where entity_no = '" . $entity_no . "')
ORDER BY date DESC, time DESC";
$get_all_history_data = $con->prepare($get_all_history_sql);
$get_all_history_data->execute([':id' => $user_id]);



$user_id = $_GET['id'];
$get_data_sql = "SELECT * FROM  tbl_entity en INNER JOIN tbl_individual oh ON  oh.entity_no = en.entity_no where oh.entity_no ='$user_id'";
$get_data_data = $con->prepare($get_data_sql);
$get_data_data->execute([':id' => $user_id]);

while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {
}
