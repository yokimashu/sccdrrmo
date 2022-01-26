<?php

include('../config/db_config.php');
include('sql_queries.php');
include('update_status.php');
include('update_void.php');
require_once '../admin/SimpleXLSXGen.php';
session_start();

$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms = $patient = $person_status =    $void_username = '';

//fetch user from database
// $get_user_sql = "SELECT * FROM tbl_users where id = :id ";
// $user_data = $con->prepare($get_user_sql);
// $user_data->execute([':id' => $user_id]);
// while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


//   $db_fullname = $result['fullname'];
// }


$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $void_username = $result['fullname'];
}


$get_all_vaccine_sql = "SELECT * FROM tbl_vaccine ORDER BY idno DESC";
$get_all_vaccine_data = $con->prepare($get_all_vaccine_sql);
$get_all_vaccine_data->execute();


$get_center = " SELECT bc_code,bc_name from tbl_bakuna_center";
$get_bakuna_data = $con->prepare($get_center);
$get_bakuna_data->execute();

if (isset($_POST['download'])) {
  $date_download = $_POST['datefrom'];
  $date_format = date('Y-m-d', strtotime($date_download));
  $bakuna_center = $_POST['center'];
  $file_name = $date_format . '_' . $bakuna_center . '.xlsx';
  $data = [[
    "Category", "CategoryID", "CategoryIDNo.", "PhilHealthID", "PWD ID", "Last Name", "First Name", "Middle Name", "Suffix",
    "Contact No", "Full Address", "Region", "Province", "MunCity", "Barangay", "Sex", "Birth Date", "Consent", "Refusal Reason", "MoreThan16yo", "PegPolysorbate", "Sever Reaction",
    "AllergytoFood", "MonitorAllergy", "BleedingDisorders", "BleedingHistory", "ManifestSymptoms", "MentionedSymptoms", "CovidHistory", "CovidTreated", "ReceivedVaccine", "AntibodiesCovid",
    "Pregnant", "PregnantSemester", "Illness", "MentionedIllness", "MedicalClearance", "Deferral", "DateVaccination", "VaccineManufacturer", "BatchNumber", "LotNumber", "VaccinatorName",
    "VaccinatorProfession", "1stDose", "2ndDose"
  ]];

  $sql_download = "SELECT v.`Category`, v.`CategoryID`, v.`CategoryIDnumber`, v.`PhilHealthID`,
v.`PWD_ID`, v.`Lastname`, v.`Firstname`, v.`Middlename`, v.`Suffix`,
v.`Contact_no`, v.`Full_address`, v.`Region`, v.`Province`, v.`MunCity`,
v.`Barangay`, v.`Sex`, v.`Birthdate_`, 
a.`consent`, a.`Refusal_Reasons`, a.`MoreThan16yo`,
a.`PegPolysorbate`, a.`Severe_Reaction`, a.`AllergyToFood`, a.`MonitorAllergy`, a.`BleedingDisorders`,
a.`BleedingHistory`, a.`ManifestSymptoms`, a.`MentionedSymptoms`, a.`CovidHistory`,
a.`CovidTreated`, a.`ReceivedVaccine`, a.`AntibodiesCovid`, a.`Pregnant`, a.`PregnantSemester`,
a.`Illness`, a.`MentionedIllness`, a.`MedicalClearance`, a.`Deferral`, a.`DateVaccination`,
a.`VaccineManufacturer`,a.`BatchNumber`, a.`LotNumber`, a.`VaccinatorName`, a.`VaccinatorProfession`,
a.`1stDose`, a.`2ndDose` FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.`entity_no` = a.`entity_no`
WHERE a.`bakuna_center_no` = :center  AND a.date_reg = :datedownload  ORDER BY a.`time_reg` ASC";

  $prep_stmt_download = $con->prepare($sql_download);
  $prep_stmt_download->execute([
    ':center' => $bakuna_center,
    ':datedownload' => $date_format
  ]);

  while ($get_download_data = $prep_stmt_download->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();
    $nestedData[] = $get_download_data["Category"];
    $nestedData[] = $get_download_data["CategoryID"];
    $nestedData[] = $get_download_data["CategoryIDnumber"];
    $nestedData[] = $get_download_data["PhilHealthID"];
    $nestedData[] = $get_download_data["PWD_ID"];
    $nestedData[] = $get_download_data["Lastname"];
    $nestedData[] = $get_download_data["Firstname"];
    $nestedData[] = $get_download_data["Middlename"];
    $nestedData[] = $get_download_data["Suffix"];
    $nestedData[] = $get_download_data["Contact_no"];
    $nestedData[] = $get_download_data["Full_address"];
    $nestedData[] = $get_download_data["Region"];
    $nestedData[] = $get_download_data["Province"];
    $nestedData[] = $get_download_data["MunCity"];
    $nestedData[] = $get_download_data["Barangay"];
    $nestedData[] = $get_download_data["Sex"];
    $nestedData[] = $get_download_data["Birthdate_"];
    $nestedData[] = $get_download_data["consent"];
    $nestedData[] = $get_download_data["Refusal_Reasons"];
    $nestedData[] = $get_download_data["MoreThan16yo"];
    $nestedData[] = $get_download_data["PegPolysorbate"];
    $nestedData[] = $get_download_data["Severe_Reaction"];
    $nestedData[] = $get_download_data["AllergyToFood"];
    $nestedData[] = $get_download_data["MonitorAllergy"];
    $nestedData[] = $get_download_data["BleedingDisorders"];
    $nestedData[] = $get_download_data["BleedingHistory"];
    $nestedData[] = $get_download_data["ManifestSymptoms"];
    $nestedData[] = $get_download_data["MentionedSymptoms"];
    $nestedData[] = $get_download_data["CovidHistory"];
    $nestedData[] = $get_download_data["CovidTreated"];
    $nestedData[] = $get_download_data["ReceivedVaccine"];
    $nestedData[] = $get_download_data["AntibodiesCovid"];
    $nestedData[] = $get_download_data["Pregnant"];
    $nestedData[] = $get_download_data["PregnantSemester"];
    $nestedData[] = $get_download_data["Illness"];
    $nestedData[] = $get_download_data["MentionedIllness"];
    $nestedData[] = $get_download_data["MedicalClearance"];
    $nestedData[] = $get_download_data["Deferral"];
    $nestedData[] = $get_download_data["DateVaccination"];
    $nestedData[] = $get_download_data["VaccineManufacturer"];
    $nestedData[] = $get_download_data["BatchNumber"];
    $nestedData[] = $get_download_data["LotNumber"];
    $nestedData[] = $get_download_data["VaccinatorName"];
    $nestedData[] = $get_download_data["VaccinatorProfession"];
    $nestedData[] = $get_download_data["1stDose"];
    $nestedData[] = $get_download_data["2ndDose"];

    $data[] = $nestedData;
  }
  SimpleXLSXGen::fromArray($data)->downloadAs($file_name);
}
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Assessment Masterlist </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <section class="content">
        <div class="card">
          <div class="card-header  text-white bg-success">
            <h4> Assessment Masterlist
            </h4>

          </div>

          <div class="card-body">
            <div class="box ">
              <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                <div class="card card-success card-outline">
                  <div class="card-header ">
                    <h5 class="m-0">GENERATE REPORT</h5>
                  </div>
                  <div class="box-body">
                    <br>
                    <div class="row">


                      <div class="col-md-1" align="right">
                        <label>Date: </label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group date">
                          <div style="padding-right:10px" class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input style="margin-right:10px;" type="text" data-provide="datepicker" class="form-control " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom">

                        </div>
                      </div>
                      <div class="col-md-1" align="right">
                        <label>Center <span id="required"></span> </label>
                      </div>
                      <div class="col-md-5">

                        <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender"> -->
                        <select class="form-control select2" id="center" name="center">
                          <option selected value=" ">Select Bakuna Center</option>
                          <?php while ($get_bkcenter = $get_bakuna_data->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $get_bkcenter['bc_code']; ?>"> <?php echo $get_bkcenter['bc_name'] ?> </option>

                          <?php } ?>
                        </select>
                      </div>

                      <!-- <div class="col-md-1"></div> -->
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-success" name="download"><i class="fa fa-download"></i></button>
                      </div>
                    </div>


                  </div><br>


                </div>

                <!-- start of deferral -->

                <div class="card" style="padding:12px;">
                  <div class="box-body">
                    <div class="table-responsive">


                      <table id="users" name="user" class="table table-bordered table-striped">
                        <thead align="center">

                          <th> Objid </th>
                          <th> Entity_no </th>
                          <th> Date Register </th>
                          <th> Category </th>
                          <th> Full Name </th>
                          <th> Date Vaccinated </th>
                          <th> 1st Dose </th>
                          <th> 2nd Dose </th>
                          <th> Vaccinator Name </th>
                          <th> Status </th>
                          <th> Bakuna Center Name</th>
                          <th>Options</th>


                        </thead>
                        <tbody>



                        </tbody>
                      </table>

                    </div>
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








  <div class="modal fade" id="modalvoid" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">VOID</h4>
        </div>



        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body-lg-50">
              <div class="form-group">

                <div class="row">
                  <div class="col-sm-7">
                    <label>VOID USERNAME: </label>
                    <input readonly="true" type="text" name="void_username" id="void_username" class="form-control" pull-right value="<?php echo $void_username ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-sm-4">
                    <label> ID:</label>
                    <input readonly="true" type="text" name="objid" id="objid" class="form-control" pull-right value="<?php echo $get_objid; ?>" required>
                  </div>
                  </div>
                  <br>

                  <div class="row">
                  <div class="col-sm-4">
                    <label> ENTITY NO.:</label>
                    <input readonly="true" type="text" name="entity_no" id="entity_no" class="form-control" pull-right value="<?php echo $entity_no; ?>" required>
                  </div>

                  <div class="col-sm-7">
                    <label> FULL NAME:</label>
                    <input readonly="true" type="text" name="fullname" id="fullname" class="form-control" pull-right value="<?php echo $fullname; ?>" required>
                  </div>

                </div><br>



                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">NO</button>
                  <input type="submit" name="update_void" class="btn btn-danger" value="SAVE">

                  <!-- <button type="submit" <?php echo $btnSave; ?> name="insert_dailypayment" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button> -->
                </div>

              </div>



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
            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">NO</button>
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
  <!-- <script src="../plugins/daterangepicker/tempusdominus.js" type="text/javascript"></script> -->
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
        url: "search_vaccine_vas.php",
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
          defaultContent: '<a class="btn btn-warning btn-sm printlink" style="margin-right:10px;" data-placement="top" title="UPDATE RECORD"> <i class="fa fa-edit"></i></a>' +
            '<a class="btn btn-danger btn-sm" style="margin-right:10px;" id="modal" data-placement="top" title="VOID"><i class="fas fa-trash-alt"></i></a>',

        },

      ],
    });


    $("#users tbody").on("click", ".printlink", function() {
      // event.preventDefault();
      var currow = $(this).closest("tr");
      var entity_no = currow.find("td:eq(0)").text();

      $('.printlink').attr("href", "add_assessment.php?id=" + entity_no, '_parent');


    });


    $("#users tbody").on("click", "#modal", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var objid = currow.find("td:eq(0)").text();
      var entity_no = currow.find("td:eq(1)").text();
      var fullname = currow.find("td:eq(4)").text();




      console.log("test");
      $('#modalvoid').modal('show');
      $('#objid').val(objid);
      $('#entity_no').val(entity_no);
      $('#fullname').val(fullname);



    });



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