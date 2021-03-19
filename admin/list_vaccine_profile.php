<?php

include('../config/db_config.php');
include('sql_queries.php');
include('update_vas.php');

// session_start();

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

$get_all_vaccine_sql = "SELECT * FROM tbl_vaccine ORDER BY idno DESC";

// $get_all_vaccine_sql = "SELECT * FROM tbl_vaccine";
$get_all_vaccine_data = $con->prepare($get_all_vaccine_sql);
$get_all_vaccine_data->execute();





?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Vaccine Registration Profile </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>
      <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>
      <section class="content">
        <div class="card card-info">
          <div class="card-header  text-white bg-success">
            <h4> Vaccine Masterlists
              <a href="add_vaccine_registry" style="float:right;" type="button" class="btn btn-success bg-gradient-success">
                <i class="nav-icon fa fa-plus-square"></i></a>

            </h4>

          </div>
          <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Import from CSV</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
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


                    <table id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">


                        <th> Entity_no </th>
                        <th> Category</th>
                        <th width="300px"> Full Name </th>
                        <th> Gender </th>
                        <th> Date of Birth </th>
                        <th> Address </th>
                        <!-- <th> Barangay </th> -->
                        <!-- <th> Municipality </th>
                        <th> Province </th>
                        <th> Region </th>
                        <th> Employed </th>
                        <th> Covid History </th> -->
                        <th>Options</th>


                      </thead>
                      <tbody>



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



  <div class="modal fade" id="modalupdate" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">FORWARD TO VAS LIST</h4>
        </div>



        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body-lg-50">
              <div class="form-group">
                <label>VAMOS ID: </label>
                <input readonly="true" type="text" name="entity_no" id="entity_no" class="form-control" pull-right value="<?php echo $entity_no; ?>" required>

             
                  <input hidden readonly="true" readonly type="text" name="date_registered" id="date_registered" class = "form-control" pull-right value="<?php echo date("y/m/d") ?>" required>
             
                <!-- <label>Time Registered:
                <input readonly="true" readonly type="text" name="time_registered" id="time_registered" class = "form-control" pull-right value="<?php echo date("H:i") ?>" required>
                </label>  -->
                <label>Remarks: </label>
                <input type="text" name="remarks" id="remarks" class="form-control" pull-right value="">


              </div>

              <!-- <div class="col-md-5">
                <label for="">STATUS:</label>
                <select class="form-control select2" style="width: 100%;" id="result" name="result" value="">
                  <option selected>Please select</option>
                  <option value="POSITIVE">POSITIVE</option>
                  <option value="NEGATIVE">NEGATIVE</option>
                  <option value="PENDING">PENDING</option>
                </select>
              </div> -->
              <!-- <label for="">MOVE TO VAST LIST:</label>
              <br> -->

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
              <input type="submit" name="update_vas" class="btn btn-danger" value="SAVE">

              <!-- <button type="submit" <?php echo $btnSave; ?> name="insert_dailypayment" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button> -->
            </div>



          </div>
        </form>
      </div>

    </div>

  </div>


  <!-- /.modal-dialog -->


  <div class="modal fade" id="delete_recordmodal" role="dialog" data-backdrop="static" data-keyboard="false">
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

                <input readonly="true" type="text" name="objid_closecontact" id="objid_closecontact" class="form-control">
              </div>



            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <input type="submit" name="delete_closecontact" class="btn btn-danger" value="Yes">
          </div>
        </form>


      </div>
    </div> <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->






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

  <script src="../plugins/sweetalert/sweetalert.min.js"></script>

  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>

  <?php

  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

  ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['status'] ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code'] ?>",
        button: "OK. Done!",
      });
    </script>

  <?php
    unset($_SESSION['status']);
  }
  ?>

  <script>
    // $('#users').DataTable({
    //   'paging': true,
    //   'lengthChange': true,
    //   'searching': true,
    //   'ordering': false,
    //   'info': true,
    //   'autoWidth': true,
    //   'autoHeight': true


    // });

    var dataTable = $('#users').DataTable({

      page: true,
      stateSave: true,
      processing: true,
      serverSide: true,
      scrollX: false,

      ajax: {
        url: "search_vaccine.php",
        type: "post",
        error: function(xhr, b, c) {
          console.log(
            "xhr=" +
            xhr.responseText +
            " b=" +
            b.responseText +
            " c=" +
            c.responseText
          );
        }
      },
      columnDefs: [{
          width: "100px",
          targets: -1,
          data: null,
          defaultContent: '<a class="btn btn-warning btn-sm printlink1" style="margin-right:10px;" data-placement="top" title="UPDATE STATUS"> <i class="fa fa-edit"></i></a>' +
            '<a class="btn btn-warning btn-sm modalupdate" style="margin-right:10px;" id="modal" data-placement="top" title="FORWARD TO VAS">VAS',
          // '<a class="btn btn-outline-success btn-sm printlink"  style = "margin-right:10px;" id="printlink" href ="../plugins/jasperreport/vaccineform.php?entity_no=" data-placement="top" target="_blank" title="Print Form">  <i class="nav-icon fa fa-print"></i></a> ',
        },

      ],
    });


    $("#users tbody").on("click", ".printlink1", function() {
      // event.preventDefault();
      var currow = $(this).closest("tr");
      var entity_no = currow.find("td:eq(0)").text();

      $('.printlink1').attr("href", "view_vaccine_profile_two.php?id=" + entity_no, '_parent');


    });

    $("#users tbody").on("click", "#modal", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var entity_no = currow.find("td:eq(0)").text();




      console.log("test");
      $('#modalupdate').modal('show');
      $('#entity_no').val(entity_no);



    });

    $("#users tbody").on("click", ".printlink", function() {
      // event.preventDefault();
      var currow = $(this).closest("tr");
      var entity = currow.find("td:eq(0)").text();
      $('.printlink').attr("href", "../plugins/jasperreport/vaccineform.php?entity_no=" + entity, '_parent');
      // window.open("../plugins/jasperreport/entity_id.php?entity_no=" + entity, '_parent');

    });



    // $("#users tbody").on("click", "#modal", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var objid = currow.find("td:eq(0)").text();




    //   console.log("test");
    //   $('#modalupdate').modal('show');
    //   $('#objid').val(objid);



    // });



    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var objid5 = currow.find("td:eq(0)").text();

        $('#delete_recordmodal').modal('show');
        $('#objid_closecontact').val(objid5);

      });
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


</body>

</html>