<?php

session_start();
include ('../config/db_config.php');
include('header.php');
if (!isset($_SESSION['id'])) {
    header('location:../index');
}

$user_id = $_SESSION['id'];

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];

}


$get_all_incident_sql = "SELECT * FROM tbl_incident ";
$get_all_incident_data = $con->prepare($get_all_incident_sql);
$get_all_incident_data->execute(); 
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $remarks   = $result['remarks'];
}



?>

<!DOCTYPE html> 
<html >



<body class="hold-transition sidebar-mini">

<div class="wrapper">
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php');?>

 
    <div class="content-wrapper">
      <div class="content-header"></div>

      
      
      <section class="content">
    
          <div class="card card-info">
            <div class="card-header">
              <h4 style="float:left;" >INCIDENT LIST</h4>
              <a href="add_incident" style="text-decoration:none;">
                <button  style="float:right; "type="button" class="btn btn-success" >Add Incident</button>
              </a>
              
            </div>
          
            <div class="card-body">

              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">

                  <div class="box-body">
                  
                    <table style = "overflow-x: auto;"id="users" class="table table-bordered table-striped">
                      <thead>
                      
                        <tr style="font-size: 1.10rem">
                            <th> ID </th>
                            <th> Date Created </th>
                            <th> Report Person </th>
                            <th> Type</th>                                                                 
                            <th> Severity</th>
                            <th> Topic </th>
                            <th> Remarks</th>
                    
                          </tr>
                          
                      </thead>

                      <tbody>
                        <?php while($incident_data = $get_all_incident_data->fetch(PDO::FETCH_ASSOC)){  
                          $account_type ='';
                          if($users_data['account_type']=='1'){
                            $account_type ='Administrator';
                          }  
                          else{
                            $account_type ='User';
                          }
                          ?>
                          <tr style="font-size: 1rem">
                            <td><?php echo $incident_data['objid'];?> </td>
                            <td><?php echo $incident_data['date'];?> </td>
                            <td><?php echo $incident_data['reported_by'];?> </td>
                            <td><?php echo $incident_data['type'];?> </td>
                            <td><?php echo $incident_data['severity'];?> </td>
                            <td><?php echo $incident_data['topic'];?> </td>
                            <td><?php echo $incident_data['remarks'];?> </td>
                          
                          <td>
                            <a class="btn btn-success btn-sm btn-flat approved" 
                            data-id=<?php echo $incident['id'];?> data-name=<?php echo $incident_data['reported_by'];?>>
                            <i class="fa fa-check"></i>
                             </a>
                           
                             <a class="btn btn-danger btn-sm delete btn-flat" 
                            href="update_users.php?objid=<?php echo $users_data['id'];?>&id=<?php echo $users_data['user_id'];?>">
                            <i class="fa fa-trash"></i>
                             </a>

                                                 
                            
                          </td>


                          </tr>
                        <?php   } ?>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>       
         
          </div>
      </section>
      
      <div class = "modal fade " id="approved">
    <div class ="modal-dialog ">
    <div class ="modal-content ">
    <div class="modal-header card-outline card-primary" >
    <h4 class ="modal-title">Do you want to approve this user?</h4>
    </div>
    <form class =form-horizontal method ="POST" action = "updatecredentials.php"  enctype="multipart/form-data">
         <div class = "modal-body ">

         <label class = col-sm-2 col-form-label"> User ID:</label>
         <input type = "text" name = "userId" readonly class="form-control" id="userId">
         <label class = col-sm-3 col-form-label"> Full Name:</label>
         <input type = "text" name = "fullname" readonly class="form-control" id="fullname">
         <div class="modal-footer">            
        
        
         <button type="submit" class="btn btn-primary btn-sm " name = "approved" ><i class="fa fa-save"></i> YES</button>

         <button type="button" class="btn  btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>CLOSE</button>
         </div>
       
         </div>                 

    </form>
    </div>
    </div>
     </div>



    </div>

  <!-- footer here -->
    <?php include('footer.php');?>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery/jquery.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../plugins/pace/pace.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
     $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "scrollX"     : true
    })
    $('.approved').click(function(e){
    e.preventDefault();
    $('#approved').modal('show');
    var id = $(this).data('id');
    var name = $(this).data('name');
      $('#userId').val(id);
      $.post("getUserdetail.php",
      {id:id},
      function(response){
        $("#fullname").html(response);
      }
      );
    
  //  getDetails(id);
    // alert(id);
    // alert(name);
  //   $.ajax({
  //   type: 'POST',
  //   url: 'updatecredentials.php',
  //   data: {id:id},
  //   dataType: 'json'
   
  // });


  });

  function getDetails(id){
    alert(id);
    $.ajax({
    type: 'POST',
    url: 'getUserdetail.php',
    data: {id2:id},
    dataType: 'json',
    success:   function(response){
      $('#fullname').val(response.fullname);
      console.log(response.fullname);
    }
    
    });
 
  }

  
</script> 
</body>
</html>