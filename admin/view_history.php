
<?php

include ('../config/db_config.php');
include ('sql_queries.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {}

$now = new DateTime();


$btnSave = $btnEdit = $get_fName = $get_lName = $get_mName= $get_age = $get_gender =
$get_brgy = $get_city = $get_province = $get_street = $get_origin = $get_arrival = $get_contact =
$get_travel = $get_disease = $get_health = $get_symptoms = $get_status = $get_date = $get_cleared = '';
$btnNew = 'hidden';




  $user_id = $_GET['id'];

  $get_all_history_sql = "SELECT * FROM tbl_history where entity_no = :id";
$get_all_histor_data = $con->prepare($get_all_histor_sql);
$get_all_histor_data->execute();


  // $get_pum_sql = "SELECT * FROM tbl_history WHERE idno = :id";
  // $get_pum_data = $con->prepare($get_pum_sql);
  // $get_pum_data->execute([':id' => $user_id]);
  // while ($result = $get_pum_data->fetch(PDO::FETCH_ASSOC)) {
  //   $get_id                 = $result['idno'];
  //   $get_date               = $result['date_report'];
  //   $get_fName              = $result['first_name'];
  //   $get_mName              = $result['middle_name'];
  //   $get_lName              = $result['last_name'];
  //   $get_age                = $result['age'];
  //   $get_gender             = $result['gender'];
  //   $get_brgy               = $result['barangay'];
  //   $get_street             = $result['street'];
  //   $get_city               = $result['city'];
  //   $get_province           = $result['province'];
  //   $get_origin             = $result['city_origin'];
  //   $get_arrival            = $result['date_arrival'];
  //   $get_contact            = $result['contact_number'];
  //   $get_travel             = $result['travel_days'];
  //   $get_disease            = $result['patient_disease'];
  //   $get_health             = $result['health_status'];
  //   $get_symptoms           = $result['symptoms'];
  //   $get_status             = $result['status'];

  //   $array_symptoms = explode(',', $get_symptoms);
  // }





?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO ERP | Update PUM</title>
     <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>

  <div class="content-wrapper" >
    <div class="content-header"></div>

      <div class="float-topright">
        <?php echo $alert_msg; ?> 
      </div>

      <section class="content" >
        <div class="card">
          <div class="card-header text-white bg-success">
            <h4>Update Person Under Monitor (PUMs)</h4>
          </div>
          
          <div class="card-body">
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF");?>"> 
              <div class="box-body"> 
                <br>


                <!-- report details -->
                <div class="card">
                  <div class="card-header"><h6>REPORT DETAILS</h6></div>
                    <div class="box-body" >
                      <br>
                        < <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">
                    <div class="row">
                      <div class="col-md-3" id="combo"></div>
                    </div>
                    <br>


                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">
                        <tr style="font-size: 1.10rem">
                          <th> ID </th>
                          <th> Date </th>
                          <th> Full Name </th>
                          <th> Address</th>
                          <th> Contact No.</th>
                          <th> Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($list_history = $get_all_history_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr align="center">
                            <td><?php echo $list_history['entity_no'];  ?></td>
                            <td><?php echo $list_history['entity_no_scaned'];  ?></td>
                    
                     
                              <a class="btn btn-success btn-sm" href="view_history.php?&id=<?php echo $list_pum['idno']; ?> ">
                                <i class="fa fa-folder-open-o"></i>
                              </a>
                              <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $list_pum["idno"]; ?>"><i class="fa fa-trash-o"></i>
                              </button>
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
                          <div class="col-md-3">
                            <label>Patient # : </label>
                            <input type="number" readonly class="form-control"  name="patient_number" id="patient_number" placeholder="Patient Number" value="" required>
                          </div>
                        </div><br>
                    </div>
                </div>

               

            

                




                <div class="box-footer" align="center">
                                
                  <button type="button"  <?php echo $btnEdit; ?> name="edit" id ="btnEdit" class="btn btn-info" >
                  <i class="fa fa-edit fa-fw"> </i>  </button>
              
                  <button type="submit"  <?php echo $btnSave; ?> name="add_pum" id="btnSubmit" class="btn btn-success" >
                  <i class="fa fa-check fa-fw"> </i> </button>
              
                  <a href="list_pum.php">
                    <button type="button" name="cancel" class="btn btn-danger">       
                    <i class="fa fa-close fa-fw"> </i> </button>
                  </a>
                </div>
                <!-- end box-footer -->
                
              </div>
              <!-- end box-body -->
            </form>
            <!-- end form -->
          </div>



                      
          
          
        </div>
   
      </section>
  </div>
  

  <?php include('footer.php')?> 

</div>



<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- CK Editor -->
<script src="../../plugins/ckeditor/ckeditor.js"></script>
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
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- textarea wysihtml style -->
<script>
  $('.select2').select2();

  $(function () {
    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
  });

  //Date picker
  $('#datepicker').datepicker({
     autoclose: true
   });

   $("#btnSubbmit").attr("disabled", true);
   $(".select2").attr("disabled", true);

   $(document).ready(function(){
        $('#btnEdit').click(function() {
          $("input[name='get_fName']").removeAttr("readonly");
          $("input[name='get_mName']").removeAttr("readonly");
          $("input[name='get_lName']").removeAttr("readonly");
          $("input[name='get_age']").removeAttr("readonly");
          $("input[name='get_street']").removeAttr("readonly");
          $("input[name='get_city']").removeAttr("readonly");
          $("input[name='get_province']").removeAttr("readonly");
          $("input[name='get_city0rigin']").removeAttr("readonly");
          $("input[name='get_number']").removeAttr("readonly");
          $("input[name='get_disease']").removeAttr("readonly");
          $("input[name='get_cleared']").removeAttr("readonly");
          
          
          // 5 ka combobox
          $(".select2").attr("disabled", false); 
          $("#btnSubmit").attr("disabled", false);
          $("#btnEdit").attr("disabled", true);
        });
    });

</script>




</body>
</html>
