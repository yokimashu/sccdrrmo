<?php 
	include ('../config/db_config.php');
  session_start();
 
  //only show delete button to session user
  $btndelete ="";
  $query = "
  SELECT * FROM tbl_reportpum 
  WHERE remarks = 'NEW REPORT'
  ORDER BY objid DESC
  ";
  $statement = $con->prepare($query);
  $statement->execute();
  
  $result = $statement->fetchAll();
  $output = '';
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