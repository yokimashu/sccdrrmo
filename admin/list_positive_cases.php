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

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}

$get_all_positive_sql = "SELECT * FROM tbl_sources_infection order by time_register DESC ";
$get_all_positive_data = $con->prepare($get_all_positive_sql);
$get_all_positive_data->execute();



?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | COVID POSITIVE CASES </title>
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
            <h4> COVID POSITIVE CASES

            <a href="https://docs.google.com/forms/d/14jZ9lnKL7cdvc1JjhWIV49qinoXivfLcJzpCUqR8IAw/edit?gxids=7757#responses" style="float:right;" type="button"> View Summary
              </a>
              <br>
              <br>

            <a href="https://docs.google.com/spreadsheets/d/1To5G2UGFsf2QcJlLMV7z465Gzef_suicarwsfDOi9co/edit#gid=1984005694" style="float:right;" type="button"> View Responses
              </a>
       
 
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
                          <th> DATE/TIME </th>
                          <th> PATIENT No. </th>
                          <th> PATIENT NAME</th>
                          <th> BARANGAY</th>
                          <th> REMARKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($list_positive = $get_all_positive_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>
                            <td><?php echo $list_positive['time_register . date_register'];  ?></td>
                            <td><?php echo $list_positive['patient_no'];  ?></td>
                            <td><?php echo $list_positive['patient_fullname']; ?> </td>
                            <td><?php echo $list_positive['barangay']; ?> </td>
                            <td><?php echo $list_positive['remarks']; ?> </td>
                           
                            <!-- <td>

                            <?php if ($_SESSION['user_type'] == 1) {
                                //restrict users to view history
                              ?>

                              <a class="btn btn-warning btn-sm" href="view_individual.php?&id=<?php echo $list_positive['entity_no']; ?> ">
                                <i class="fa fa-edit"></i></a>

                                <?php } ?>

                              <?php if ($_SESSION['user_type'] == 1) {
                                //restrict users to view history
                              ?>
                                <a class="btn btn-success btn-sm" href="view_individual_history.php?&entity_no=<?php echo $list_individual['entity_no']; ?> ">
                                  <i class="fa fa-suitcase"></i></a>

                              <?php } ?>
                              <a class="btn btn-danger btn-sm" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $list_individual['entity_no'];  ?>">
                                <i class="nav-icon fa fa-print"></i></a>
                              </a>
                              &nbsp;

                            </td> -->
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </form>
            </div>
          </div>
       

      </section>



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
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true,
      initComplete: function() {
        this.api().columns([4]).every(function() {
          var column = this;
          var select = $('<select class="form-control select2"><option value="">show all</option></select>')
            .appendTo('#combo')
            .on('change', function() {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );
              column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
            });
          column.data().unique().sort().each(function(d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
          });
        });
      }

    });
    $('.select2').select2();

    $('#addPUM').on('hidden.bs.modal', function() {
      $('#addPUM form')[0].reset();
    });

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



    // $(document).ready(function() {
    //   $('#print').click(function() {
    //     var entity_no = $('#entity_no').val();
    //     console.log(entity_no);

    //     $('#printlink').attr("href", "../plugins/jasperreport/entity_id.php?entity_no=" + entity_no, '_parent');
    //   })
    // });




    $('#users tbody').on('click', 'button.printlink', function() {
      // alert ('hello');
      // var row = $(this).closest('tr');
      var table = $('#users').DataTable();
      var data = table.row($(this).parents('tr')).data();
      //  alert (data[0]);
      //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
      var entity_no = data[0];
      window.open("entity_id.php?entity_no=" + entity_no, '_parent');
    });

    $('#add_individual').click(function() {
      generateID();
    });

    function generateID() {

      $.ajax({
        type: 'POST',
        data: {},
        url: 'generate_id.php',
        success: function(data) {
          //$('#entity_no').val(data);
          sessionStorage.setItem("entity_number", data);
        }
      });
    }
    // window.onload = generateID;
  </script>
</body>

</html>