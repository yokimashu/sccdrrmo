<?php

include('../config/db_config.php');
// include('sql_queries.php');
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms = $patient = $person_status = '';

//fetch user from database
// $get_user_sql = "SELECT * FROM tbl_users where id = :id ";
// $user_data = $con->prepare($get_user_sql);
// $user_data->execute([':id' => $user_id]);
// while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


//   $db_fullname = $result['fullname'];
// }

$get_all_infection_sql = "SELECT * FROM tbl_sources_infection ORDER BY idno  DESC";
$get_all_infection_data = $con->prepare($get_all_infection_sql);
$get_all_infection_data->execute();





?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Master Lists Sources of Infection </title>
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
            <h4> Confirmed Cases Masterlist

              <a href="add_positive_case" style="float:right;" type="button" class="btn btn-success bg-gradient-success">
                <i class="nav-icon fa fa-plus-square"></i></a>

            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">


                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">
                        <tr>
                          <th> DATE & TIME </th>
                          <th> TRACER NAME</th>
                          <th> PATIENT ID </th>
                          <th> PATIENT NAME </th>
                          <th> STATUS </th>
                          <!-- <th></th> -->

                          <th>OPTIONS</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($list_infection = $get_all_infection_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>
                            <td><?php echo $list_infection['date_register'];
                                echo " / ";
                                echo   $list_infection['time_register']; ?></td>
                            <td><?php echo $list_infection['tracer_fullname']; ?> </td>
                            <td><?php echo $list_infection['patient_no']; ?> </td>
                            <td><?php echo $list_infection['patient_fullname']; ?></td>
                            <td><?php echo $list_infection['status']; ?></td>

                            <td>

                              <!-- <a class="btn btn-warning btn-sm" href="view_positive_case.php?&id=<?php echo $list_infection['patient_no']; ?> ">
                                <i class="fa fa-edit"></i></a> -->


                              <?php if ($_SESSION['user_type'] == 1) {
                                //restrict users to view history
                              ?>
                                <!-- <a class="btn btn-success btn-sm" href="view_juridical_history.php?&entity_no=<?php echo $list_infection['entity_no']; ?> ">
                                  <i class="fa fa-suitcase"></i></a> -->


                              <?php } ?>


                              <!-- <a class="btn btn-danger btn-sm" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/juridical_id_new.php?entity_no=<?php echo $list_infection['entity_no'];  ?>">
                                <i class="nav-icon fa fa-print"></i></a>
                              </a> -->

                              <!-- <?php if ($_SESSION['user_type'] == 1) {
                                      //restrict users to view history
                                    ?>
                                <button class="btn btn-danger delete btn-sm" data-placement="top" title="Delete Individual"><i class="fa fa-trash-o"></i></button>


                              <?php } ?> -->


                              &nbsp;

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



    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

  </div>

  <div class="modal fade" id="delete_PUMl" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="user_id" id="user_id" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
            <input type="submit" name="delete_pum" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
      // initComplete: function() {
      //   this.api().columns([4]).every(function() {
      //     var column = this;
      //     var select = $('<select class="form-control select2"><option value="">show all</option></select>')
      //       .appendTo('#combo')
      //       .on('change', function() {
      //         var val = $.fn.dataTable.util.escapeRegex(
      //           $(this).val()
      //         );
      //         column
      //           .search(val ? '^' + val + '$' : '', true, false)
      //           .draw();
      //       });
      //     column.data().unique().sort().each(function(d, j) {
      //       select.append('<option value="' + d + '">' + d + '</option>')
      //     });
      //   });
      // }

    });
    $('.select2').select2();



    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });

    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#delete_PUMl').modal('toggle');

    });
  </script>

  <script>




  </script>
</body>

</html>