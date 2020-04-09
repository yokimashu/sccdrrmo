<?php 
	include ('../config/db_config.php');
  session_start();
  
	if(isset($_POST['id'])){

    $id = $_POST['id'];
    $query = "UPDATE tbl_reportpum SET remarks = 'READ' WHERE objid = '$id' ";
    $stmt = $con->prepare($query);
    $stmt->execute();
    
		$id = $_POST['id'];
		$get_id_sql = "SELECT * FROM tbl_reportpum WHERE objid = :id";
    $get_id_data = $con->prepare($get_id_sql);
    $get_id_data->execute([':id'=>$id]);
    while ($result2 = $get_id_data->fetch(PDO::FETCH_ASSOC)) {

  $id       = $result2['objid'];
  $date     = $result2['date'];
  $time    = $result2['time'];
  $fullname   = $result2['fullname'];
  $contactno   = $result2['contactno'];
  $address   = $result2['address'];
  if($result2['travel'] == 'YES'){$travel = "<input type='checkbox' name ='travel' checked>";}else{$travel = "<input type='checkbox' name ='travel'>";};
  if($result2['travelhistory'] == 'YES'){$travelhistory = "<input type='checkbox' name ='travelhistory' checked>";}else{$travelhistory = "<input type='checkbox' name ='travelhistory'>";};
  if($result2['symptoms'] == 'YES'){$symptoms = "<input type='checkbox' name ='symptoms' checked>";}else{$symptoms = "<input type='checkbox' name ='symptoms'>";};
  $reportedby  = $result2['reportedby'];
  $mobileno  = $result2['mobileno'];
  
  
}

$row = array(
  'id'         => $id,
  'date'      => $date,
  'time'     => $time,
  'fullname'     => $fullname,
  'contactno'     => $contactno,
  'address'     => $address,
  'travel'         => $travel,
  'travelhistory'      => $travelhistory,
  'symptoms'     => $symptoms,
  'reportedby'     => $reportedby,
  'mobileno'     => $mobileno,
  

);
    echo json_encode($row);
    
	}
?>