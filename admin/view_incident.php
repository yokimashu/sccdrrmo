
<?php

include ('../config/db_config.php');
include ('update_incident.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}

date_default_timezone_set('Asia/Manila');  
$date = date('Y-m-d');
$time = date('H:i:s');



//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $db_fullname = $result['fullname'];

}


$btnSave = $btnMap = $get_objid = $get_time = $get_date = 
$get_name = $get_details = $get_type = $get_serivity = '';

  $user_id = $_GET['id'];

  $get_incident_sql = "SELECT * FROM tbl_incident WHERE objid = :id ";
  $get_incident_data = $con->prepare($get_incident_sql);
  $get_incident_data->execute([':id' => $user_id]);
  while ($result = $get_incident_data->fetch(PDO::FETCH_ASSOC)) {
    $get_objid                  = $result['objid'];  
    $get_date                   = $result['date'];
    $get_time                   = $result['time'];
    $get_name                   = $result['reported_by'];
    $get_type                   = $result['type'];
    $get_severity               = $result['severity'];
    $get_mobileno               = $result['mobileno'];
    $get_details                = $result['topic'];
    $get_createdat              = $result['createdat'];
    $latitude                   = $result['latitude'];
    $longitude                  = $result['longitude'];


  }

  // // this is an example of valid latitude ang longitude
  // $lat = $latitude;
  // $lon = $longitude;

?>

 

<!DOCTYPE html>
<html>
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




    <section class="content col-md-10" >

 
        <div class="card card-info "  >
         
                <div class="card-header">
                  <h3>View Incident Records </h3>
                </div>
                <div class="card-body" >
                  <form role="form" method="post" action="update_incident.php">
                    
                    <div class="box-body">
                      
                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>ID No:</label>
                            </div>
                            <div class="col-md-3" >
                              <input type="text" readonly  class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="objid" placeholder="ID NO" value="<?php echo $get_objid;?>" required>
                            </div>
                          </div><br>

                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>Date:</label>
                            </div>
                            <div class="col-md-2" align="center" >
                              <input type="text" readonly class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="date" placeholder="Date" value="<?php echo $get_date;?>" required>
                            </div>
                            <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                              <label>Time:</label>
                            </div>
                            <div class="col-md-2" align="center">
                            <input type="text" readonly class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="time" placeholder="Time" value="<?php echo $get_time;?>" required>     
                            </div>
                          </div><br>


                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>Type:</label>
                            </div>
                            <div class="col-md-2" align="center" >
                              <input type="text" readonly class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="type" placeholder="Type" value="<?php echo $get_type;?>" required>
                            </div>
                            <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                              <label>Serivity:</label>
                            </div>
                            <div class="col-md-2" align="center">
                            <input type="text" readonly class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="severity" placeholder="Serivity" value="<?php echo $get_severity;?>" required>     
                            </div>
                          </div><br>




                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>Name:</label>
                            </div>
                            <div class="col-md-5" >
                              <input type="text" readonly align="center" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="name" placeholder="Name" value="<?php echo $get_name;?>" required>
                            </div>
                          </div><br>

                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>Mobile Number:</label>
                            </div>
                            <div class="col-md-5" >
                              <input type="text" readonly align="center" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="mobileno" placeholder="Mobile Number" value="<?php echo $get_mobileno;?>" required>
                            </div>
                          </div><br>

                 


                          <div class="form-group"> 
                 
                              <label>Details of Incident:</label>
                         
                       
                              <textarea type="text" readonly align="center" class="form-control" row="5"  name="topic" placeholder="Details of Incident" value="<?php echo $get_details;?>" required></textarea>
                     
                          </div><br>
                               
                          <!-- /.box-body -->
                          <div class="box-footer" align="center">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mapModal">Location</button>

                              <button type="button"  <?php echo $btnMap; ?> name="image" id ="image" class="btn btn-info" >
                              <label>Photo</label> </button>


                              <a href="list_incident.php">
                                <button type="button" name="cancel" class="btn btn-danger">       
                                <i class="fa fa-close fa-fw"> </i> </button>
                            </a>
                          </div>

                    </div>
                  
                  </form>
                </div>
              <!-- /.box -->
        </div>
       

    </section>
    


    <!-- modals here -->

    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Map</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row col-md-12">
              <iframe width="800" height="340" frameborder="0" src = "https://maps.google.com/maps?q=<?= $latitude ?>,<?= $longitude ?>&hl=es;z=14&amp;output=embed"></iframe>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div  class="modal fade"  id="modal-image">
     <div class="modal-dialog">

     <div class="modal-header card-outline card-primary" >
                    <h4 class="modal-title"><b>Photo</b></h4>
               </div>  

               
               	<div class="modal-body" style ="align:center; width:80%;">
                 <form class="form-horizontal" id ="userform">
                 <div class="form-group row">

                  <image id = "displayimage">  </image>

                 </div>
                 </form>
                 </div>
                 </div>
                 </div>





  </div>
  <!-- /.content-wrapper -->
 <?php include('footer.php')?>

</div>

<!-- add pum modal -->









<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<!-- DataTables Bootstrap -->
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>

<script>
     $('.select2').select2();

    $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true
     
    });



 
$('#image').click(function(){
  $('#modal-image').modal('toggle');
   var id = $('#objid').val();

   $('#displayimage').load('get_photo.php',{image:id
  },
  function(response, status, xhr) {
  if (status == "error") {
      alert(msg + xhr.status + " " + xhr.statusText);
      console.log(msg + xhr.status + " " + xhr.statusText);
  }
   )};
  // $.ajax({

  //   type:"POST",
  //   url:'get_photo.php',
  //   data:{image:id},
  //   success:function(response){
  //     // var result = jQuery.parseJSON(response);
  //    // document.getElementById("displayImage").setAttribute("src",response.image);
  //     alert(response);
  //   },
  //   error: function (xhr, b, c) {
  //             console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
  //           }

  // })
});
</script>
</body>
</html>