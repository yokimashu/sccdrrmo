<?php 
	include ('../config/db_config.php');
  session_start();
 
  $output = '';

  $query2 = "
  SELECT * FROM tbl_incident 
  WHERE remarks = 'NEW REPORT'
  ORDER BY objid DESC
  ";
  $statement2 = $con->prepare($query2);
  $statement2->execute();
  
  $result2 = $statement2->fetchAll();
 
  foreach($result2 as $row)
  {
     $output .= '
     <div class="col-12 col-sm-6 col-md-12">
     <div class="info-box btn-outline-danger mb-3">
      <a href="view_incident.php?&id='.$row["objid"].'" class="Ashake info-box-icon bg-danger elevation-1"><span ><i class="fa fa-exclamation"></i></span></a>
        <div class="info-box-content">
          <span class="info-box-text"><h4>INCIDENT REPORT!</h4></span>
          <span>DATE REPORTED:<b> '.$row["createdat"].' </b></span> <br>
          <span>TYPE:<b> '.$row["type"].' </b>
          SEVERITY:<b> '.$row["severity"].' </b></span> <br>
          <span>ADDRESS:<b> '.$row["location_address"].' </b></span>
        </div>
     </div>
     </div>
   ';
}

  $query = "
  SELECT * FROM tbl_reportpum 
  WHERE remarks = 'NEW REPORT'
  ORDER BY objid DESC
  ";
  $statement = $con->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
     $output .= '
     <div class="col-12 col-sm-6 col-md-12">
     <div class="info-box btn-outline-danger mb-3">
      <a href="report_pum" class="Ashake info-box-icon bg-danger elevation-1"><span ><i class="fa fa-exclamation"></i></span></a>
        <div class="info-box-content">
          <span class="info-box-text">REPORT PUI/PUM</span>
          <span>DATE REPORTED:<b> '.$row["createdat"].' </b></span> <br>
          <span>ADDRESS:<b> '.$row["address"].' </b></span>
        </div>
     </div>
     </div>
   ';
}

echo $output;
?>