
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
$get_travel = $get_disease = $get_health = $get_symptoms = $get_status = $get_date = '';
$btnNew = 'hidden';


if (isset($_GET['objid'])) {

  $user_id = $_GET['id'];
  $get_pum_sql = "SELECT * FROM tbl_pum WHERE idno = :id";
  $get_pum_data = $con->prepare($get_pum_sql);
  $get_pum_data->execute([':id' => $user_id]);
  while ($result = $get_pum_data->fetch(PDO::FETCH_ASSOC)) {
    $get_id                 = $result['idno'];
    $get_date               = $result['date_report'];
    $get_fName              = $result['first_name'];
    $get_mName              = $result['middle_name'];
    $get_lName              = $result['last_name'];
    $get_age                = $result['age'];
    $get_gender             = $result['gender'];
    $get_brgy               = $result['barangay'];
    $get_street             = $result['street'];
    $get_city               = $result['city'];
    $get_province           = $result['province'];
    $get_origin             = $result['city_origin'];
    $get_arrival            = $result['date_arrival'];
    $get_contact            = $result['contact_number'];
    $get_travel             = $result['travel_days'];
    $get_disease            = $result['patient_disease'];
    $get_health             = $result['health_status'];
    $get_symptoms           = $result['symptoms'];
    $get_status             = $result['status'];

  }
}


$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms where status ='Active'";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();


$get_all_health_sql = "SELECT * FROM tbl_health";
$get_all_health_data = $con->prepare($get_all_health_sql);
$get_all_health_data->execute();

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

              
                
                <!-- personal information -->
                <div class="card">
                  <div class="card-header"><h6>PERSONAL INFORMATION</h6></div>
                    <div class="box-body" >
                      <br>
                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="text" readonly  class="form-control"  name="fName" placeholder="First Name" value="<?php echo $get_fName;?>" required>
                          </div>
                          <div class="col-md-3" >
                            <input type="text" readonly class="form-control"  name="mName" placeholder="Middle Name" value="<?php echo $get_mName;?>" required>
                          </div>
                          <div class="col-md-3">
                            <input type="text" readonly class="form-control"  name="lName" placeholder="Last Name" value="<?php echo $get_lName;?>" required>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="number" readonly class="form-control"  name="age" placeholder="Age" value="<?php echo $get_age;?>" required>
                          </div>
                          <div class="col-md-3 " >
                            <select class="form-control select2" name="gender" value="<?php echo $get_gender; ?>">
                              <option >Select Gender</option>
                              <option <?php if ($get_gender == 'Female') echo 'selected'; ?> value="Female">Female </option>
                              <option <?php if ($get_gender == 'Male') echo 'selected'; ?> value="Male">Male </option>
                            </select>   
                          </div>
                          <div class="col-md-3 " >
                            <select class="form-control select2" readonly id="barangay" name="barangay" value="<?php echo $type; ?>">
                              <option>Please select...</option>
                                <?php while ($get_brgy_data = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <?php  $selected = ($get_brgy == $get_brgy_data['barangay'])? 'selected':''; ?>
                                <option <?=$selected;?> value="<?php echo $get_brgy_data['barangay']; ?>"><?php echo $get_brgy_data['barangay']; ?></option> 
                              <?php } ?>
                            </select>
                          </div>
                        </div><br> 

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="text" readonly class="form-control"  name="street" placeholder="Street / Lot # / Block #" value="<?php echo $get_street;?>" required>
                          </div>
                          
                          <div class="col-md-3 " >
                            <input type="text" readonly class="form-control"  name="city" placeholder ="City / Municipality" value="<?php echo $get_city;?>" required>  
                          </div>
                          <div class="col-md-3 " >
                            <input type="text" readonly class="form-control"  name="province" placeholder="Province" value="<?php echo $get_province;?>" required>  
                          </div>
                        </div><br>
                    </div>  
                </div>
         
                <!-- travel history -->
                <div class="card">
                  <div class="card-header"><h6>TRAVEL HISTORY</h6></div>
                    <div class="box-body" >
                      <br>
                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="text" readonly class="form-control"  name="city0rigin" placeholder="City of Origin" value="<?php echo $get_origin;?>" required>
                          </div>
                          <div class="col-md-3">
                            <div class="input-group date" data-provide="datepicker" >
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" readonly class="form-control pull-right" id="datepicker" name="date_arrival" placeholder="Date Arrival"  value="<?php echo $get_arrival;?>">
                            </div>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3">
                            <input type="number" readonly class="form-control"  name="contact_number" placeholder="Contact Number" value="<?php echo $get_contact;?>" required>
                          </div>
                         
                          <div class="col-md-3">
                            <select class=" form-control select2" id="travel_days"  name="travel_days" value="<?php echo $get_travel;?>">
                                  <option selected="selected">Traveled during the past 14 days?</option>
                                  <option <?php if ($get_travel == 'Yes') echo 'selected'; ?> value="Yes">Yes </option>
                                  <option <?php if ($get_travel == 'No') echo 'selected'; ?> value="No">No </option>
                            </select>
                          </div>
                        </div><br>
                     
                    </div>
                </div>
                
                <!--  -->
                <div class="card">
                  <div class="card-header"><h6>HEALTH HISTORY</h6></div>
                    <div class="box-body" >
                      <br>
                        <div class="row" >
                          <div class="col-md-1"></div>

                          <div class="col-md-3">
                            <input type="text" readonly class="form-control"  name="disease" placeholder="Patient's Disease" value="<?php echo $get_disease;?>" required>
                          </div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <select class="form-control select2" readonly id="symptoms_data" name="symptoms_data" value="<?php echo $get_symptoms; ?>">
                              <option>Select Symptoms</option>
                                <?php while ($get_symptoms_data = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <?php  $selected = ($get_symptoms == $get_symptoms_data['symptoms'])? 'selected':''; ?>
                                <option <?=$selected;?> value="<?php echo $get_symptoms_data['symptoms']; ?>"><?php echo $get_symptoms_data['symptoms']; ?></option> 
                              <?php } ?>
                            </select>
                          </div>


                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <select class="form-control select2" readonly id="health" name="health" value="<?php echo $get_health; ?>">
                              <option>Select Patient Status</option>
                                <?php while ($get_health_data = $get_all_health_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <?php  $selected = ($get_health == $get_health_data['health_status'])? 'selected':''; ?>
                                <option <?=$selected;?> value="<?php echo $get_health_data['health_status']; ?>"><?php echo $get_health_data['health_status']; ?></option> 
                              <?php } ?>
                            </select>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          
                          <div class="col-md-3">
                            <div class="input-group date" data-provide="datepicker" >
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" readonly class="form-control pull-right" id="datepicker" name="date_process" placeholder="Date Process" 
                                  value="<?php echo $get_date; ?>">
                            </div>
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

   $("#btnSubmit").attr("disabled", true);
   $(".select2").attr("disabled", true);

   $(document).ready(function(){
        $('#btnEdit').click(function() {
          $("input[name='firstname']").removeAttr("readonly");
          $("input[name='middlename']").removeAttr("readonly");
          $("input[name='lastname']").removeAttr("readonly");
          $("input[name='age']").removeAttr("readonly");
          $("input[name='street']").removeAttr("readonly");
          $("input[name='city']").removeAttr("readonly");
          $("input[name='province']").removeAttr("readonly");
          $("input[name='city0rigin']").removeAttr("readonly");
          $("input[name='date_arrival']").removeAttr("readonly");
          $("input[name='contact_number']").removeAttr("readonly");
          $("input[name='date_process']").removeAttr("readonly");
          $("input[name='disease']").removeAttr("readonly");

          $(".select2").attr("disabled", false);
          $("#btnSubmit").attr("disabled", false);
          $("#btnEdit").attr("disabled", true);
        });
    });

</script>




</body>
</html>
