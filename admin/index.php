
<?php

include ('../config/db_config.php');
// $user_id = $_SESSION['id'];

// if (!isset($_SESSION['id'])) {
//     header('location:../index.php');
// } else {

// }

//select all pum
$get_all_pum_sql = "SELECT * FROM tbl_pum";
$get_all_pum_data = $con->prepare($get_all_pum_sql);
$get_all_pum_data->execute();

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

    <div class="container-fluid">      
 
     <div class="row">

         <div class="col-12 col-sm-6 col-md-3">
           <div class="info-box mb-3">
            <a href="list_pum.php" class="info-box-icon bg-warning elevation-1"><span ><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Person Under Monitor</span>
                <span class="info-box-number">
                  <?php echo $get_all_pum_data->rowCount()?>
                </span>
              </div>
           </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3">
           <div class="info-box mb-3">
            <a class="info-box-icon bg-orange elevation-1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span ><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Person Under Investigation</span>
                <span class="info-box-number">
                  5
                  <?php echo "<pre";
echo print_r($_SESSION['user_type']);
echo "</pre>";
?>
                </span>
              </div>
           </div>
         
           <div class="collapse" id="collapseExample">
         
              <div class="card p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>PUI Number</th>
                      <th>Address</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 PUI</td>
                      <td>S. Carmona Street, Zone 1, Brgy.6</td>
                      <td><span class="badge bg-danger">HOT ZONE</span></td>
                    </tr>
                    <tr>
                      <td>3 PUIs</td>
                      <td>St. Vincent Subdivision, Brgy. 1</td>
                      <td><span class="badge bg-danger">HOT ZONE</span></td>
                    </tr>
                    <tr>
                      <td>1 PUI</td>
                      <td>Brgy. Quezon</td>
                      <td><span class="badge bg-danger">HOT ZONE</span></td>
                    </tr>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            
            </div>


         </div>       


     
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
           <div class="info-box mb-3">
            <a href="#" class="info-box-icon bg-danger elevation-1"><span ><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Confirmed Cases</span>
                <span class="info-box-number">
                  0
                </span>
              </div>
           </div>
         </div> 
         <div class="col-12 col-sm-6 col-md-3">
           <div class="info-box mb-3">
            <a href="https://l.facebook.com/l.php?u=http%3A%2F%2F35.241.87.123%2Fsccdrrmo%2Fdownloads%2Fsccdrrmo-debug.apk%3Ffbclid%3DIwAR0eJLQpLG70Lzhdg0weckbotiJYaWGDhn6Xeod02JdVYRsp5WTWeBBWuJQ&h=AT2gVGncAsQuz5w21zjmxl3mg5xmpozBoqrE389XiULW_h4S4OUYzVJe66sWkVf--BeZJcVuX0eh6w_s1MYeMhDrKr7fkAnOhVtX-y_RghGnJXA7V7C39tHKkEOb0b-hQGsgEQ" class="info-box-icon bg-success  elevation-1"><span ><i class="fa fa-download "></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Download Application</span>
                
              </div> 
           </div>
         </div>

      </div><!-- end row -->
   </div><!-- end container-fluid -->
    

  </div><!-- /.content-wrapper -->
  
 <?php include('footer.php')?>

</div>

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
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
$('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true
    })
  </script>
</body>
</html>
