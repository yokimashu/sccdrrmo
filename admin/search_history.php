<?php

include('../config/db_config.php');
$entity_no = $_POST['entity_no'];
$date_from =  date('Y-m-d', strtotime($_POST['date_from']));
$date_to =    date('Y-m-d', strtotime($_POST['date_to']));

// echo "<p>";
// echo print_r($date_from);
// echo "</p>";
$columns= array( 
    // datatable column index  => database column name
        0 =>  'entity_no', 
        1 => 'date',
        2 => 'fullname',
        3 => 'details',
        4 => 'mobile_no'
    


    );
$requestData= $_REQUEST;

if(isset($_POST['date_from'])){

    $get_all_history_sql = "Select * FROM
    (
        SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_individual i on i.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
    
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_individual i on i.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
        
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, j.org_name, CONCAT(j.street, ', ', j.barangay) as details, j.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_juridical j on j.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
    
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, j.org_name, CONCAT(j.street, ', ', j.barangay) as details, j.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_juridical j on j.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
    
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, l.vehicle_name, l.plate_no, l.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_landtranspo l on l.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
        
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, l.vehicle_name, l.plate_no, l.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_landtranspo l on l.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
        
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, s.vessel_name, s.voyage_no, s.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_seatranspo s on s.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
        
    UNION
    
    SELECT date, time, t.entity_no, t.trace_no, s.vessel_name, s.voyage_no, s.mobile_no FROM `tbl_tracehistory` t
    inner join tbl_seatranspo s on s.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."' or t.trace_no = '" . $entity_no . "' AND t.date between '".$date_from."' and '".$date_to."'
        
    ) dum
    WHERE fullname NOT IN (Select fullname from tbl_individual where entity_no = '" . $entity_no . "'
    )
    ORDER BY date DESC, time DESC LIMIT ".$requestData['start']." ,".$requestData['length']." ";
        $data = array();
        $get_all_history_data = $con->prepare($get_all_history_sql);
        $get_all_history_data->execute();
        while ($list_history = $get_all_history_data->fetch(PDO::FETCH_ASSOC)) {
            $nestedData=array(); 

            $nestedData[] = $list_history["trace_no"];
            $nestedData[] = $list_history["date"]. "/" .$list_history['time'];
            $nestedData[] = $list_history["fullname"];
            $nestedData[] = $list_history["details"];
            $nestedData[] = $list_history["mobile_no"]; 
            $data[] = $nestedData;

        }

        $count_stmt = "	SELECT COUNT(entity_no) as totalcount from tbl_tracehistory where entity_no = '".$entity_no."' and Date between '".$date_from."' and '".$date_to."'";
        $getrecordstmt = $con->prepare($count_stmt);
        $getrecordstmt->execute() or die("search_history.php");
        $getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['totalcount'];
        $totalFiltered = $totalData;

        if(!empty($requestData['search']['value'])){


        }


        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
        
            echo json_encode($json_data);  // send data as json format

}


?>