
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {}

$now = new DateTime();

$btnSave = $btnEdit='';
$btnNew = 'hidden';


$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms";
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
  <title>SCCDRRMO | Add Announcement</title>
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

      <section class="content" >
        <div class="card">
          <div class="card-header text-white bg-success">
            <h3>Add PUMs / PUIs </h3>
          </div>


          <div class="card-body">
            <form role="form" method="post" action="update_pum.php"> 
              <div class="box-body"> 
                
                <!-- personal information -->
                <div class="card">
                  <div class="card-header"><h6>PERSONAL INFORMATION</h6></div>
                    <div class="box-body" >
                      <br>
                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="text"  class="form-control"  name="firstname" placeholder="First Name" value="" required>
                          </div>
                          <div class="col-md-3" >
                            <input type="text"  class="form-control"  name="middlename" placeholder="Middle Name" value="" required>
                          </div>
                          <div class="col-md-3">
                            <input type="text"  class="form-control"  name="lastname" placeholder="Last Name" value="" required>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="number"  class="form-control"  name="age" placeholder="Age" value="" required>
                          </div>
                          <div class="col-md-3 " >
                            <select class=" form-control select2" id="gender"  name="gender" value="">
                                <option selected="selected">Select Gender</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </select>
                          </div>
                          <div class="col-md-3 " >
                            <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="">
                                <option selected="selected">Select Barangay</option>
                                <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_brgy['barangay']; ?>"><?php echo $get_brgy['barangay']; ?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="text"  class="form-control"  name="street" placeholder="Street / Lot # / Block #" value="" required>
                          </div>
                          
                          <div class="col-md-3 " >
                            <input type="text"  class="form-control"  name="city" placeholder ="City / Municipality" value="" required>  
                          </div>
                          <div class="col-md-3 " >
                            <input type="text"  class="form-control"  name="province" placeholder="Province" value="" required>  
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
                            <input type="text"  class="form-control"  name="idno" placeholder="City of Origin" value="" required>
                          </div>
                          <div class="col-md-3">
                            <div class="input-group date" data-provide="datepicker" >
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" name="date_arrival" placeholder="Date Arrival" 
                                  value="">
                            </div>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3">
                            <input type="number"  class="form-control"  name="contact_number" placeholder="Contact Number" value="" required>
                          </div>
                         
                          <div class="col-md-3">
                            <select class=" form-control select2" id="travel_days"  name="travel_days" value="">
                                  <option selected="selected">Traveled during the past 14 days?</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
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
                            <input type="text"  class="form-control"  name="disease" placeholder="Patient's Disease" value="" required>
                          </div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <select class="form-control select2" id="symptoms" style="width: 100%;" name="symptoms" value="">
                                <option selected="selected">Health Status</option>
                                <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                                <?php } ?>
                            </select>
                          </div>


                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <select class="form-control select2" id="heath_status" style="width: 100%;" name="health_status" value="">
                                <option selected="selected">Health Status</option>
                                <?php while ($get_health = $get_all_health_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_health['health_status']; ?>"><?php echo $get_health['health_status']; ?></option>
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
                                <input type="text" class="form-control pull-right" id="datepicker" name="date_process" placeholder="Date Process" 
                                  value="">
                            </div>
                          </div>
                         
                         
                        </div><br>
                     
                    </div>
                </div>


                
                <div class="box-footer" align="center">
                                
                  <button type="button"  <?php echo $btnEdit; ?> name="edit" id ="btnEdit" class="btn btn-info" >
                  <i class="fa fa-edit fa-fw"> </i>  </button>

                  <button type="submit"  <?php echo $btnSave; ?> name="update_pum" id="btnSubmit" class="btn btn-success" >
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
</script>




</body>
</html>
