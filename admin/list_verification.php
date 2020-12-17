<?php

include('../config/db_config.php');
include('sql_queries.php');
session_start();
$user_id = $_SESSION['id'];

// include('verify_admin.php');
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}



date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms = $patient = $person_status = $entity_no = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}


$get_new_submission = "SELECT * FROM tbl_individual i inner join tbl_verification e on i.entity_no = e.entity_no WHERE status = 'NEW SUBMISSION'";
$get_new_submission_record = $con->prepare($get_new_submission);
$get_new_submission_record->execute();



?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | User Verification Master List </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <section class="content">
        <div class="card card-info">
          <div class="card-header  text-white bg-success">
            <h4> User Verification

              <a href="add_sea_trans" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a>
              <!-- <a href="../cameracapture/capture.php" style="float:right;" type="button" class="btn btn-info bg-gradient-info" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a> -->
            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">
                    <!-- <div class="row">
                      <div class="col-md-3" id="combo"></div>
                    </div>
                    <br> -->


                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">
                        <tr style="font-size: 1.10rem">

                          <th> Entity No. </th>
                          <th> Full Name </th>
                          <th> Options</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php while ($list_sea = $get_new_submission_record->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>

                            <td><?php echo $list_sea['entity_no'];  ?></td>
                            <td><?php echo $list_sea['fullname']; ?> </td>
                            <td>
                              <button class="btn btn-warning btn-sm" id = "verify" >
                                <i class="fa fa-edit"></i></a>
                    </td>
                          </tr>
                        <?php } ?>






                      </tbody>
                    </table>


                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </section>
      <br>
      <?php include('user_verification_modal.php');?>

    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

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
  <!-- DataTables Bootstrap -->
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>

  <script>
  loadSubmit();
 function loadSubmit(){
  
  $('#users').DataTable({
    'stateSave':true,
      'destroy':true,
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    })

 }
   


    $('#users tbody').on('click', '#verify', function(e) {
      // alert ('hello');
      // var row = $(this).closest('tr');
      event.preventDefault();
      var table = $('#users').DataTable();
      var data = table.row($(this).parents('tr')).data();
      //  alert (data[0]);
      //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
      var entity_no = data[0];
      // alert(entity_no);

      $('#verify_modal').modal('toggle');
    });
  </script>
</body>

</html>