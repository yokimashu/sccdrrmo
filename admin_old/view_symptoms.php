
<?php

include ('../config/db_config.php');
include ('update_symptoms.php');
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


$btnSave = $btnEdit = $get_time = $get_date = $get_id=
$get_fullname = $get_symptoms = $get_status= '';

  $user_id = $_GET['id'];

  $get_pum_sql = "SELECT * FROM tbl_symptoms WHERE idno = :id and status='Active'";
  $get_pum_data = $con->prepare($get_pum_sql);
  $get_pum_data->execute([':id' => $user_id]);
  while ($result = $get_pum_data->fetch(PDO::FETCH_ASSOC)) {
    $get_id                     = $result['idno'];  
    $get_symptoms               = $result['symptoms'];
    $get_status                 = $result['status'];
  }



?>

 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Update PUM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Select2-->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" align="center">
    <div class="content-header"></div>


    <section class="content col-md-10" >

 
        <div class="card card-info "  >
         
                <div class="card-header text-white bg-success">
                  <h3>Update Symptoms </h3>
                </div>
                <div class="card-body" align="center">
                  <form role="form" method="post" action="update_symptoms.php">
                    
                    <div class="box-body">
                      
                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>ID No:</label>
                            </div>
                            <div class="col-md-3" >
                              <input type="text" readonly  class="form-control"  name="id_number" placeholder="ID NO" value="<?php echo $get_id;?>" required>
                            </div>
                          </div><br>

                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>Symptoms:</label>
                            </div>
                            <div class="col-md-3" >
                              <input type="text" readonly align="center" class="form-control"  name="symptoms" placeholder="Symptoms" value="<?php echo $get_symptoms;?>" required>
                            </div>
                          </div><br>
                          
                          <div class="row"> 
                            <div class="col-md-4" style="text-align: right;padding-top: 5px;">
                              <label>Status:</label>
                            </div>
                            <div class="col-md-2" >
                              <input type="text" readonly class="form-control"  name="status" placeholder="Status" value="<?php echo $get_status;?>" required>
                            </div>
                          </div><br>                
        
                               
                          <!-- /.box-body -->
                          <div class="box-footer" align="center">
                          
                              <button type="button"  <?php echo $btnEdit; ?> name="edit" id ="btnEdit" class="btn btn-info" >
                              <i class="fa fa-edit fa-fw"> </i>  </button>

                              <button type="submit"  <?php echo $btnSave; ?> name="update_symptoms" id="btnSubmit" class="btn btn-success" >
                              <i class="fa fa-check fa-fw"> </i> </button>

                              <a href="list_pum.php">
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

    $('#addPUM').on('hidden.bs.modal', function () {
        $('#addPUM form')[0].reset();
    });

    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });


    $("#btnSubmit").attr("disabled", true);
    $("#name_symptoms").attr("disabled", true);

    $(document).ready(function(){
        $('#btnEdit').click(function() {
          $("input[name='symptoms']").removeAttr("readonly");
          $("input[name='status']").removeAttr("readonly");
          $("#name_symptoms").attr("disabled", false);
          $("#btnSubmit").attr("disabled", false);
          $("#btnEdit").attr("disabled", true);
        });
    });

</script>
</body>
</html>
