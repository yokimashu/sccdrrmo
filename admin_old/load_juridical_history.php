<?php
include('../config/db_config.php');
if (isset($_POST['entity_no'])) {
    $entity_no =   $_POST['entity_no'];
    $date_from =  date('Y-m-d', strtotime($_POST['date_from']));
    $date_to =    date('Y-m-d', strtotime($_POST['date_to']));


    $get_all_juridical_sql = "Select * FROM
    (
        SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_individual i on i.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
    
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_individual i on i.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
        
    ) dum 
    
    WHERE fullname NOT IN (Select org_name from tbl_juridical where entity_no = '" . $entity_no . "')
    ORDER BY date DESC, time DESC";
    $get_all_juridical_data = $con->prepare($get_all_juridical_sql);
    $get_all_juridical_data->execute();

    
    while ($list_history = $get_all_juridical_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $list_history['entity_no'];
        echo "</td>";
        echo "<td>";
        echo $list_history['date']."/".$list_history['time'];
        echo "</td>";
        echo "<td>";
        echo $list_history['fullname'];
        echo "</td>";
        echo "<td>";
        echo $list_history['details'];
        echo "</td>";
        echo "<td>";
        echo $list_history['mobile_no'];
        echo "</td>";
        echo "</tr>";

    }
 
}


?>