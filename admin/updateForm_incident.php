<?php


session_start();

$codecateg = $namecategory = '';
if (!isset($_SESSION['id'])) {
    header('location:../index');
}

$user_id = $_SESSION['id'];

include ('../../config/db_config.php');

include ('update_approvedby.php');

//select user
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
}

$get_lastname = $get_middlename =$get_firstname =
$get_status_data = $type = $get_idno = $get_position = $get_status='';

if (isset($_GET['objid'])) {
  $user_id = $_GET['id'];

  $get_incident_sql = "SELECT * FROM tbl_incident WHERE objid = :id";
  $get_incident_data = $con->prepare($get_incident_sql);
  $get_incident_data->execute([':id' => $user_id]);
  while ($result = $get_incident_data->fetch(PDO::FETCH_ASSOC)) {
      $get_objid = $result['objid'];

   

  }

}


include ('header.php');
include ('sidebar.php');
?>
<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini">
<div class="wrapper">





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
      </div>

    <!-- Main content -->
    <section class="content">
    <div class="card">
            <div class="card-header">
              <h3 class="card-title">Incident Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
          
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            <?php echo $alert_msg; ?>
              <div class="box-body">
              
              <div class="row">
                  <div class="col-md-2" hidden style="text-align: right;padding-top: 5px;">
                   <label>ID No.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" hidden  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="idno" placeholder="idno" value="<?php echo $get_idno; ?>" required>
                  </div>
                </div><br>


              <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Date:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id ="date" name="date" placeholder="date" value="<?php echo $get_date; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Reported by:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id ="reported_by"  name="reported_by" placeholder="reported_by" value="<?php echo $get_reported_by; ?>" required>
                  </div>
                </div><br>

               
           



              <!-- /.box-body -->
              <div class="box-footer" align="center">
              <input type="button"  <?php echo $btnEdit; ?> name="edit" id ="btnEdit" class="btn btn-primary" value="Edit">
                <input type="submit"  <?php echo $btnSave; ?> name="update_approvedby" id="btnSubmit" class="btn btn-primary" value="Update">
                <a href="list_approvedby">
                  <input type="button" name="cancel" class="btn btn-default" value="Cancel">       
                </a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-1"></div>
      </div>




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 ITCSO <a href="http://lguscc.gov.ph">Local Government of San Carlos City</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0.0-alpha
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<!-- <script src="../plugins/morris/morris.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
<!-- jvectormap -->
<!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
<!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
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
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- Page script -->

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

<script type="text/javascript">

  $(document).ready(function() {

    $(document).ajaxStart(function () {
      Pace.restart()
    })  

  });


</script>
<script>

$("#btnSubmit").attr("disabled", true);


</script>

<script>
    $(document).ready(function()
    {
    $('#btnEdit').click(function()
    {
      $("input[name='firstname']").removeAttr("readonly");
      
      $("select[name='itemunit']").removeAttr("readonly");
      $("input[name='lastname']").removeAttr("readonly");
      $("select[name='position']").removeAttr("readonly");
      $("input[name='middlename']").removeAttr("readonly");  
    //   $("textarea[name='description']").removeAttr("readonly"); 
      $("select[name='status']").removeAttr("readonly");
      $("select[name='department']").removeAttr("readonly");
      


      $("#btnSubmit").attr("disabled", false);
      $("#btnEdit").attr("disabled", true);





    });

    });

    include ('footer.php');
</script>


</body>
</html>