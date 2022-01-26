<?php

include('../config/db_config.php');
include('sql_queries.php');
include('update_status.php');
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

$get_all_contact_sql = "SELECT * FROM tbl_closecontact ORDER BY objid  DESC";
$get_all_contact_data = $con->prepare($get_all_contact_sql);
$get_all_contact_data->execute();



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
            <h4> Close Contact Masterlists
              <a href="add_contact_case" style="float:right;" type="button" class="btn btn-success bg-gradient-success">
                <i class="nav-icon fa fa-plus-square"></i></a>

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

                          <th> OBJID </th>
                          <th> DATE&TIME </th>

                          <th> INDEX</th>
                          <th> ID </th>
                          <th> PATIENT</th>
                          <th> BARANGAY </th>
                          <th> SYPMTOMS </th>
                          <th> STATUS </th>
                          <!-- <th></th> -->

                          <th>OPTIONS</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($list_contact = $get_all_contact_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>

                            <td><?php echo $list_contact['objid']; ?> </td>
                            <td><?php echo $list_contact['date_register'];
                                echo " / ";
                                echo   $list_contact['time_register']; ?></td>

                            <td><?php echo $list_contact['index_name']; ?> </td>
                            <td><?php echo $list_contact['patient_id']; ?> </td>

                            <td><?php echo $list_contact['patient_fullname']; ?></td>
                            <td><?php echo $list_contact['patient_barangay']; ?></td>
                            <td><?php echo $list_contact['symptoms_signs']; ?></td>
                            <td><?php echo $list_contact['status']; ?></td>

                            <td>

                              <a class="btn btn-warning btn-sm" style="margin-right:10px;" id="modal" data-placement="top" title="UPDATE STATUS"> <i class="fa fa-edit"></i></a>

                              <a class="btn btn-success btn-sm" href="view_close_contact.php?&id=<?php echo $list_contact['objid']; ?> ">
                                <i class="fa fa-folder-open-o"></i></a>

                                <a class="btn btn-outline-success btn-sm printlink" style="margin-right:10px;" id="printlink" href="../plugins/jasperreport/closecontact.php?objid=" data-placement="top" target="_blank" title="Report Close Contact">
                                  <i class="nav-icon fa fa-print"></i></a>


                                <button class="btn btn-danger delete btn-sm" id="delete_record" data-placement="top" title="Delete Record"><i class="fa fa-trash-o"></i></button>
                                <!-- <button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "viewIndividual" data-placement="top" title="Edit Individual"> <i class="fa fa-edit"></i></button> -->

                                <!--                           
                                <button class="btn btn-warning btn-sm"  data-placement="top" title="UPDATE"> <i class="fa fa-edit"></i></button> -->





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



  <div class="modal fade" id="modalupdate" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPDATE STATUS</h4>
        </div>



        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body-lg-50">
              <div class="form-group">
                <label>ID:</label>
                <input readonly="true" type="text" name="objid" id="objid" class="form-control" value="<?php echo $objid; ?>" required>


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
              <label for="">STATUS:</label>
              <br>
              <input type="radio" name="status" <?php if (isset($status) && $status == "PENDING") echo "checked"; ?> value="PENDING">PENDING<br>
              <input type="radio" name="status" <?php if (isset($status) && $status == "POSITIVE") echo "checked"; ?> value="POSITIVE">POSITIVE<br>
              <input type="radio" name="status" <?php if (isset($status) && $status == "NEGATIVE") echo "checked"; ?> value="NEGATIVE">NEGATIVE<br>


            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
              <input type="submit" name="update_status" class="btn btn-danger" value="SAVE">

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
                <input readonly="true" type="text" name="fullname2" id="fullname2" class="form-control">
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


    $("#users tbody").on("click", ".printlink", function() {
      // event.preventDefault();
      var currow = $(this).closest("tr");
      var objid = currow.find("td:eq(0)").text();
      $('.printlink').attr("href", "../plugins/jasperreport/closecontact.php?objid=" + objid, '_parent');
      // window.open("../plugins/jasperreport/entity_id.php?entity_no=" + entity, '_parent');

    });


    $("#users tbody").on("click", "#modal", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var objid = currow.find("td:eq(0)").text();




      console.log("test");
      $('#modalupdate').modal('show');
      $('#objid').val(objid);



    });



    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var objid5 = currow.find("td:eq(0)").text();
        var fullname2 = currow.find("td:eq(1)").text();
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