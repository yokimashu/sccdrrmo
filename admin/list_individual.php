<?php

include('../config/db_config.php');
include('sql_queries.php');
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms = $patient = $person_status = $entity_no = '';

$btnSave = $btnEdit = $get_entity_no = $get_username = $get_password = $get_new_password = $get_date_register = $get_firstname = $get_middlename = $get_lastname = $get_birthdate =
  $get_age = $get_gender = $get_street =  $get_city =  $get_province =  $get_mobile_no =  $get_telephone_no =  $get_barangay =  $get_email = '';
$btnNew = 'hidden';
$alert_msg = '';
$img = '';
//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}

$get_all_individual_sql = "SELECT * FROM tbl_individual i inner join tbl_entity e on e.entity_no = i.entity_no order by i.lastname ASC ";
$get_all_individual_data = $con->prepare($get_all_individual_sql);
$get_all_individual_data->execute();
// $list_individual['firstname'];
// $list_individual['middlename'];
// $list_individual['lastname'];





?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Master Lists Individual </title>
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
            <h4> Master Lists Individual

              <a href="add_individual" id="add_individual" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
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
                          <th> ID </th>
                          <th> Username </th>
                          <th> Full Name </th>
                          <th> Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($list_individual = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>
                            <td><?php echo $list_individual['entity_no'];  ?></td>
                            <td><?php echo $list_individual['username'];  ?></td>
                            <td><?php echo $list_individual['fullname']; ?> </td>
                            <td>
                              <?php if ($_SESSION['user_type'] == 1) {
                                //restrict users to view history
                              ?>

                              <a class="btn btn-outline-success btn-sm" href="view_individual.php?&id=<?php echo $list_individual['entity_no']; ?>" data-placement="top" title="Edit Individual">
                                <i class="fa fa-edit"></i></a>

                              <a class="btn btn-outline-success btn-sm" target="blank" id="printlink" href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $list_individual['entity_no'];  ?>" data-placement="top" title="Print ID">
                                <i class="nav-icon fa fa-print"></i></a>
                              </a>

                              <?php if ($_SESSION['user_type'] == 1) {
                                //restrict users to view history
                              ?>
                                <a class="btn btn-outline-warning btn-sm" href="view_individual_history.php?&entity_no=<?php echo $list_individual['entity_no']; ?>" data-placement="top" title="View History">
                                  <i class="fa fa-search"></i></a>

                                <button class="btn btn-danger delete btn-sm" data-id="<?php echo $list_individual["entity_no"]; ?>" data-placement="top" title="Delete Individual"><i class="fa fa-trash-o"></i></button>

                              <?php } ?> <?php if ($_SESSION['user_type'] == 3) {
                                            //restrict users to view history
                                          ?>
                                <a class="btn btn-success btn-sm" href="view_individual_history.php?&entity_no=<?php echo $list_individual['entity_no']; ?> ">
                                  <i class="fa fa-suitcase"></i></a>

                              <?php } ?>


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
        <br>
      </section>

    </div><!-- /.content-wrapper -->

    <div class="modal fade" id="delete_individual" role="dialog" data-backdrop="static" data-keyboard="false">
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
                  <input readonly="true" type="text" name="entity_no" id="entity_no" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
              <input type="submit" name="delete_individual" class="btn btn-danger" value="Yes">
            </div>
          </form>
        </div>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->

    <?php include('footer.php') ?>

  </div><!-- /.wrapper -->




  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Morris.js charts -->
  <script src="../plugins/morris/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
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
  <script src="../plugins/select2/select2.full.min.js"></script>
  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    });
    // $('#users').DataTable({
    //   'paging': true,
    //   'lengthChange': true,
    //   'searching': true,
    //   'ordering': true,
    //   'info': true,
    //   'autoWidth': true,
    //   'autoHeight': true,
    //   initComplete: function() {
    //     this.api().columns([4]).every(function() {
    //       var column = this;
    //       var select = $('<select class="form-control select2"><option value="">show all</option></select>')
    //         .appendTo('#combo')
    //         .on('change', function() {
    //           var val = $.fn.dataTable.util.escapeRegex(
    //             $(this).val()
    //           );
    //           column
    //             .search(val ? '^' + val + '$' : '', true, false)
    //             .draw();
    //         });
    //       column.data().unique().sort().each(function(d, j) {
    //         select.append('<option value="' + d + '">' + d + '</option>')
    //       });
    //     });
    //   }

    // });

    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete_individual').modal('show');
        var id = $(this).data('id');
        $('#entity_no').val(id);
      });
    });

    // $(document).on('click', 'button[data-role=individual_delete]', function(event) {
    //   event.preventDefault();

    //   var entity_no = ($(this).data('id'));

    //   $('#entity_no').val(entity_no);
    //   $('#delete_individual').modal('show');

    // });

    // $('.select2').select2();

    // $('#addPUM').on('hidden.bs.modal', function() {
    //   $('#addPUM form')[0].reset();
    // });

    // $(function() {
    //   $('[data-toggle="datepicker"]').datepicker({
    //     autoHide: true,
    //     zIndex: 2048,
    //   });
    // });




    $('.select2').select2();


    // $(function() {
    //   $('[data-toggle="datepicker"]').datepicker({
    //     autoHide: true,
    //     zIndex: 2048,
    //   });
    // });




    // $(document).ready(function() {
    //   $('#print').click(function() {
    //     var entity_no = $('#entity_no').val();
    //     console.log(entity_no);

    //     $('#printlink').attr("href", "../plugins/jasperreport/entity_id.php?entity_no=" + entity_no, '_parent');
    //   })
    // });




    // $('#users tbody').on('click', 'button.printlink', function() {
    //   // alert ('hello');
    //   // var row = $(this).closest('tr');
    //   var table = $('#users').DataTable();
    //   var data = table.row($(this).parents('tr')).data();
    //   //  alert (data[0]);
    //   //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
    //   var entity_no = data[0];
    //   window.open("entity_id.php?entity_no=" + entity_no, '_parent');
    // });

    // $('#add_individual').click(function() {
    //   generateID();
    // });

    // function generateID() {

    //   $.ajax({
    //     type: 'POST',
    //     data: {},
    //     url: 'generate_id.php',
    //     success: function(data) {
    //       //$('#entity_no').val(data);
    //       sessionStorage.setItem("entity_number", data);
    //     }
    //   });
    // }
    // window.onload = generateID;
  </script>
</body>

</html>