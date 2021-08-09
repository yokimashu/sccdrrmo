<?php

include('../config/db_config.php');
include('sql_queries.php');
include('update_vas_test.php');
include('update_void_vaccine.php');



// include('get_vaccination_profile_two.php');



// session_start();

$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
date_default_timezone_set('Asia/Manila');

$now = new DateTime();
// $date = date('Y-m-d');
$time = date('H:i:s');



$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $vas_username = $result['fullname'];
}




$symptoms = $patient = $person_status = $get_consent =  $entity_no = $final_cbrno = '';

//fetch user from database
// $vas_entity_no = ' ';

// $get_assessment_sql = "SELECT * FROM tbl_assessment where entity_no = :id ";
// $assestment_data = $con->prepare($get_assessment_sql);
// $assestment_data->execute([':id' => $vas_entity_no]);
// while ($result = $assestment_data->fetch(PDO::FETCH_ASSOC)) {


//   $vas_entity_no = $result['entity_no'];
// }

$get_all_vaccine_sql = "SELECT * FROM tbl_vaccine ORDER BY idno DESC";

// $get_all_vaccine_sql = "SELECT * FROM tbl_vaccine";
$get_all_vaccine_data = $con->prepare($get_all_vaccine_sql);
$get_all_vaccine_data->execute();




$get_all_center_sql = "SELECT * FROM tbl_bakuna_center ";

// $get_all_vaccine_sql = "SELECT * FROM tbl_vaccine";
$get_all_center_data = $con->prepare($get_all_center_sql);
$get_all_center_data->execute();




// if (isset($_GET['entity_no'])) {

//   $entity_no = $_GET['entity_no'];

// $get_data_sql = "SELECT * FROM tbl_assessment t inner join tbl_vaccine r on r.entity_no = t.entity_no where r.entity_no = :id";
// $get_data_data = $con->prepare($get_data_sql);
// $get_data_data->execute([':id' => $entity_no]);

// while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {
//   $get_1stDose      = $result['1stDose'];
//   $get_2ndDose       = $result['2ndDose'];

// }
// }


// $entity_no = $_GET['entity_no'];





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

                        <th> OBJID </th>
                        <th> Entity_no </th>
                        <th> Category</th>
                        <th width="300px"> Full Name </th>
                        <th> Birthdate </th>
                        <th> Address</th>
                        <!-- <th style="background-color:#EDCD15"> Consent </th>
                        <th style="background-color:#157DEC"> Sinovac </th>
                        <th style="background-color:#ED157E"> Astrazeneca </th>
                        <th style="background-color:#7FFF00"> Pfizer </th>

                        <th style="background-color:#FF0000"> Johnsons </th> -->
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title ">FORWARD TO VAS LIST</h4>
        </div>



        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body-lg">
              <div class="form-group">

                <div class="row">
                  <div class="col-sm-3">
                    <label>Date: </label>
                    <div class="input-group date" data-provide="datepicker">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input readonly type="text" class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">

                    </div>
                  </div>
                  <div class="col-sm-4">
                    <label>VAS Username: </label>
                    <input readonly="true" type="text" name="vas_username" id="vas_username" class="form-control" pull-right value="<?php echo $vas_username; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-sm-3">
                    <label>VAMOS ID: </label>
                    <input readonly="true" type="text" name="entity_no" id="entity_no" class="form-control" pull-right value="<?php echo $entity_no; ?>" required>
                  </div>
                  <div class="col-sm-8">
                    <label>FULL NAME: </label>
                    <input readonly="true" type="text" name="fullname" id="fullname" class="form-control" pull-right value="<?php echo $fullname; ?>" required>
                  </div>

                </div><br>


                <div class="row">
                  <div class="col-sm-8">
                    <label>Bakuna Center</label>
                    <div class="col-sm-1"></div>

                    <select class="form-control " id="center" style="width: 100%;" name="center" value="<?php echo $center; ?>" required>
                      <option value=" " selected>SELECT BAKUNA CENTER</option>
                      <?php while ($get_center = $get_all_center_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $get_center['bc_name']; ?>"><?php echo $get_center['bc_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label>Bakuna Center No</label>
                    <div class="col-sm-1"></div>
                    <input readonly="true" type="text" name="cbrno" id="cbrno" class="form-control" pull-right value="<?php echo $final_cbrno ?>" required>

                  </div>

                </div><br>


                <div class="row">


                  <?php

                  $get_vaccination_sql = "SELECT * FROM tbl_assessment where entity_no = :id and status = 'VACCINATED'";
                  $get_vaccination_data = $con->prepare($get_vaccination_sql);
                  $get_vaccination_data->execute([':id' => $entity_no]);

                  $count = $get_vaccination_data->rowCount();

                  while ($result = $get_vaccination_data->fetch(PDO::FETCH_ASSOC)) {
                    $get_vaccine       = $result['VaccineManufacturer'];
                  }






                  ?>

                  <div class="col-sm-3">
                    <input hidden readonly="true" readonly type="text" name="date_registered" id="date_registered" class="form-control" pull-right value="<?php echo $now->format('Y-m-d'); ?>" required>
                    <label>Remarks: </label>
                    <input type="text" style="color:red; font-weight: 900;" name="remarks" id="remarks" class="blink_me" placeholder="VACCINATED" pull-right value="VALIDATED">
                    <br>
                  </div>

                  <!-- <div class="col-sm-4">
                    <input hidden readonly="true" readonly TYPE="text" NAME="date_registered" id="date_registered" class="form-control" pull-RIGHT VALUE="<?php echo $now->format('Y-m-d'); ?>" required>
                    <label>Vaccination STATUS: </label>

                    <?php if ($count == 1) { ?>
                      <input type="text" style="color:red; font-weight: 900;" name="remarks" id="remarks" class="blink_me" placeholder="VACCINATED" pull-RIGHT value="<?php echo $get_vaccine . $count ?>">
                    <?php } else if ($count == 2) { ?>
                      <input type="text" style="color:red; font-weight: 900;" name="remarks" id="remarks" class="blink_me" placeholder="VACCINATED" pull-RIGHT value="<?php echo $get_vaccine . $count ?>">
                    <?php } else { ?>
                      <input type="text" style="color:red; font-weight: 900;" name="remarks" id="remarks" class="blink_me" placeholder="VACCINATED" pull-RIGHT value="NOT YET VACCINATED">
                    <?php } ?>
                    <br>
                  </div> -->



                </div><br>

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



                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
                  <input type="submit" name="update_vas_test" class="btn btn-danger" value="SAVE">

                  <!-- <input type="submit" id="btnSubmit" name="update_vas_test" class="btn btn-danger" value="SAVE"> -->




                </div>
              </div>
            </div>
        </form>


      </div>

    </div>
  </div>

  <!-- /.modal-dialog -->


  <div class="modal fade" id="modal1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">VOID</h4>
        </div>



        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body-lg-50">
              <div class="form-group">
                <label>ID:</label>
                <input readonly="true" type="text" name="entity_no" id="entity_no" class="form-control" pull-right value="<?php echo $entity_no; ?>" required>
                <input readonly="true" type="text" name="fullname" id="fullname1" class="form-control" pull-right value="<?php echo $fullname; ?>" required>
              </div>

              <label>Remarks: </label>
              <input type="text" name="remarks" id="remarks" class="form-control" pull-right value="">


            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
              <input type="submit" name="update_void_vaccine" class="btn btn-danger" value="SAVE">

              <!-- <button type="submit" <?php echo $btnSave; ?> name="insert_dailypayment" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button> -->
            </div>



          </div>
        </form>
      </div>

    </div>

  </div>




  <?php include('pluginscript.php') ?>

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
    $('.select2').select2({
      dropdownParent: $('#modalupdate')
    });

    // $('.select2').select2();
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
        url: "search_vaccine_test.php",
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
            '<a class="btn btn-warning btn-sm " style="margin-right:10px;" id="modal"  data-placement="top" title="FORWARD TO VAS">VAS' +
            '<a class="btn btn-danger" style="margin-right:10px;" id="modal1" data-placement="top" title="VOID">x',
          // '<a class="btn btn-outline-success btn-sm printlink"  style = "margin-right:10px;" id="printlink" href ="../plugins/jasperreport/vaccineform.php?entity_no=" data-placement="top" target="_blank" title="Print Form">  <i class="nav-icon fa fa-print"></i></a> ',
        },

      ],
    });


    $("#users tbody").on("click", ".printlink1", function() {
      // event.preventDefault();
      var currow = $(this).closest("tr");
      var entity_no = currow.find("td:eq(1)").text();

      $('.printlink1').attr("href", "view_vaccine_profile_two.php?id=" + entity_no, '_parent');


    });

    $("#users tbody").on("click", "#modal", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var entity_no = currow.find("td:eq(1)").text();

      var fullname = currow.find("td:eq(3)").text();
      var consent = currow.find("td:eq(4)").text();
      var sinovac = currow.find("td:eq(5)").text();
      var astrazeneca = currow.find("td:eq(6)").text();
      var pfizer = currow.find("td:eq(7)").text();


      $('#modalupdate').modal('show');
      $('#entity_no').val(entity_no);

      $('#fullname').val(fullname);
      $('#consent').val(consent).trigger('change');
      $('#sinovac').val(sinovac).trigger('change');
      $('#astrazeneca').val(astrazeneca).trigger('change');
      $('#pfizer').val(pfizer).trigger('change');




    });


    $('#center').on('change', function() {
      var cbr_no = $(this).val();

      //  $('#doc_no').val(type);


      $.ajax({
        type: 'POST',
        data: {
          cbr_no: cbr_no
        },
        url: 'generate_cbrno.php',
        success: function(data) {
          $('#cbrno').val(data);

        }

      });

    });


    // $('#center').change(function() {
    //   if ($('#cbrno').val() == '') {
    //     $.ajax({
    //       type: 'POST',
    //       data: {},
    //       url: 'generate_cbrno.php',
    //       success: function(data) {
    //         //$('#entity_no').val(data);
    //         document.getElementById("cbrno").value = data;
    //         console.log(data);
    //       }
    //     });
    //   }
    // });



    $("#users tbody").on("click", "#modal1", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var objid = currow.find("td:eq(0)").text();
      var fullname = currow.find("td:eq(3)").text();




      console.log("test");
      $('#modalvoid').modal('show');
      $('#objid').val(objid);
      $('#fullname1').val(fullname);



    });

    $(function blink() {
      $('.blink_me').fadeOut(500).fadeIn(500, blink);
    })();

    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var objid5 = currow.find("td:eq(0)").text();

        $('#delete_recordmodal').modal('show');
        $('#objid_closecontact').val(objid5);

      });
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
  </script>



  <script>
    $("#btnSubmit").click(function() {

      var center = $('#center :selected').text();
      var consent = $('#consent :selected').text();
      var sinovac = $('#sinovac :selected').text();
      var astrazeneca = $('#astrazeneca :selected').text();



      //  alert (category);
      if (center == 'SELECT BAKUNA CENTER') {
        alert("*** Please fill-out BAKUNA CENTER ***");
        $('#center').focus();
        return false;

      } else if (consent == 'PLEASE SELECT') {
        alert("*** Please fill-out CONSENT ***");
        $('#consent').focus();
        return false;

      } else if (sinovac == 'PLEASE SELECT') {
        alert("*** Please fill-out SINOVAC ***");
        $('#sinovac').focus();
        return false;
      } else if (astrazeneca == 'PLEASE SELECT') {
        alert("*** Please fill-out ASTRAZENECA ***");
        $('#astrazeneca').focus();
        return false;
      } else return;

    });
  </script>


</body>

</html>