<?php
session_start();


date_default_timezone_set('Asia/Manila');  

$date = $dept = $pr_sai_no = $saidate = $pr_section= $prcontrolno = $reqby = $checkby = $purpose = $notes = '';
$currentDateTime = date('Y-m-d H:m');
// echo $currentDateTime;
$date = date('Y-m-d H:i');

$curYear = date('Y');




if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
$user_id = $_SESSION['id']; 

$alert_msg = '';  
include ('../config/db_config.php');


//select user


?>

<!DOCTYPE html>
<html >
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Add PR</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->

  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

  <script src="js/bootstrap-dialog.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>



  <!-- Left side column. contains the logo and sidebar -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><b>(PR)</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Add Info</b>
        <!-- <small>Version 2.0</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="../index"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Info</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF");?>">
              
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

  <!-- footer here -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?php echo 2018; ?>.</strong> All rights
      reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../bower_components/pace/pace.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
      $('.select2').select2();

      $('#users').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false,
            'autoHeight'  : false
      });


      $(document).ready(function() { 
        $("#data_items").click(function() { 
          var value = $("#myselection option:selected"); 

 $('#unit').val($('#unit').val() + value);
           // alert(value.text()); 
        }); 
      });
      




</script>

<script>
$(document).ready(function(){
   
   
});
</script>



</body>
</html>