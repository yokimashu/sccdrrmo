<?php

// session_start();
include ('../config/db_config.php');
include ('verify_admin.php');
// if (!isset($_SESSION['id'])) {  
//     header('location:../index');
// }

$user_id = $_SESSION['id'];

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];

}


$get_all_incident_sql = "SELECT * FROM tbl_incident ORDER BY objid DESC";
$get_all_incident_data = $con->prepare($get_all_incident_sql);
$get_all_incident_data->execute();


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Dashboard</title>
  <?php include('header.php');?>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>
    
    <section class="content">
            <div class="card card-info">
                    <div class="card-header">
                        <h4  >LIST OF INCIDENT</h4>
                       
                        
                    </div>
          
            <div class="card-body">

              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">

                  <div class="box-body">
                  
                    <table id="users" class="table table-bordered table-striped">
                      <thead>
                      
                        <tr style="font-size: 1.10rem">
                            <th> ID </th>
                            <th> Date</th>
                            <th> Time</th>      
                            <th> Type</th>                                                                 
                            <th> Severity</th>
                            <th> Topic </th>
                            <th> Reported_by </th>
                            <th> Remarks</th>
                           <th>Options</th>
                    
                          </tr>
                          
                      </thead>

                      <tbody>
                        <?php while($incident_data = $get_all_incident_data->fetch(PDO::FETCH_ASSOC)){  
                          
                          
                          ?>
                          <tr style="font-size: 1rem">
                            <td><?php echo $incident_data['objid'];?> </td>
                            <td><?php echo $incident_data['date'];?> </td>
                            <td><?php echo $incident_data['time'];?> </td>
                            <td><?php echo $incident_data['type'];?> </td>
                            <td><?php echo $incident_data['severity'];?> </td>
                            <td><?php echo $incident_data['topic'];?> </td>
                            <td><?php echo $incident_data['reported_by'];?> </td>
                            <td><?php echo $incident_data['remarks'];?> </td>
                            
                          
                          <td>
                          <a class="btn btn-danger btn-sm" href="view_incident.php?&id=<?php echo $incident_data['objid'];?> ">
                           <i class="fa fa-folder-open-o"></i> Open
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
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

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
    });
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