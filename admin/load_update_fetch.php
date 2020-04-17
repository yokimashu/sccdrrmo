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
     <div class="small-box modal-dialog">
     <div class="modal-content bg-danger">
           <form class="form-horizontal" id ="userform">  
           <div class = "modal-body">
             <div class = "container">
               <div class="inner">
           <h3>INCIDENT REPORT!</h3>
           <div class="row">
            <div class="col-2">
             <div class="align-items-center">
                 <a href="view_incident.php?&id='.$row["objid"].'" class="Ashake btn info-box-icon btn-dark elevation-1"><span ><i class="fa fa-exclamation"></i></span></a>
             </div>
            </div>
            <div class="col-10">

                 <div class="form-group">
                   <p><b>TYPE:</b> '.$row["type"].' <b>SEVERITY:</b> '.$row["severity"].'</p>
                 </div>

                 <div class="form-group">
                   <p><b>ADDRESS:</b> '.$row["location_address"].' </p>
                 </div>

                 <div class="form-group">
                   <p><b>DATE REPORTED:</b> '.$row["createdat"].' </p>
                 </div>
             </div>
          </div><!-- row -->
               </div> <!-- inner -->
               <div class="icon">
                 <i class="fa fa-ambulance"></i>
               </div>
               </div> <!-- modal body -->
             </div> <!-- container -->
           </form> 
         
       </div> <!-- modal content -->
     </div> <!-- modal dialog -->


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
     <div class="small-box modal-dialog">
     <div class="modal-content bg-danger">
           <form class="form-horizontal" id ="userform">  
           <div class = "modal-body">
             <div class = "container">
               <div class="inner">
           <h3>REPORT PUI/PUM</h3>
           <div class="row">
            <div class="col-2">
             <div class="align-items-center">
                 <a href="report_pum" class="Ashake btn info-box-icon btn-dark elevation-1"><span ><i class="fa fa-exclamation"></i></span></a>
             </div>
            </div>
            <div class="col-10">
                 <div class="form-group">
                   <p><b>ADDRESS:</b> '.$row["address"].' </p>
                 </div>
                 <div class="form-group">
                   <p><b>DATE REPORTED:</b> '.$row["createdat"].' </p>
                 </div>
             </div>
          </div><!-- row -->
               </div> <!-- inner -->
               <div class="icon">
                 <i class="fa fa-ambulance"></i>
               </div>
               </div> <!-- modal body -->
             </div> <!-- container -->
           </form> 
         
       </div> <!-- modal content -->
     </div> <!-- modal dialog -->
'
;
}

echo $output;
?>