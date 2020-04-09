
<?php

include ('../config/db_config.php');

session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}

date_default_timezone_set('Asia/Manila');  

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_fullname = $result['fullname'];
}


$btnSave = $btnEdit = $get_id =
$get_fname ='';


if (isset($_GET['objid'])) {

  $user_id = $_GET['id'];
  $get_pum_sql = "SELECT * FROM tbl_pum WHERE idno = :id";
  $get_pum_data = $con->prepare($get_pum_sql);
  $get_pum_data->execute([':id' => $user_id]);
  while ($result = $get_pum_data->fetch(PDO::FETCH_ASSOC)) {
    $get_id                     = $result['idno'];
    $get_fname                  = $result['first_name'];
  

     
   

  }

}


$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms where status='ACTIVE'";
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
  <title>SCCDRRMO | Update PUM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Select2-->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header"></div>

<!-- 
      <div class="float-topright">
        <?php echo $alert_msg; ?> 
      </div> -->

      <section class="content" >
        <div class="card">
          <div class="card-header text-white bg-success">
            <h5>UPDATE PUM </h5>
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
                            <input type="text" readonly  class="form-control"  name="firstname" placeholder="First Name" value="<?php echo $get_fname;?>" required>
                          </div>
                          <div class="col-md-3" >
                            <input type="text" readonly class="form-control"  name="middlename" placeholder="Middle Name" value="" required>
                          </div>
                          <div class="col-md-3">
                            <input type="text" readonly class="form-control"  name="lastname" placeholder="Last Name" value="" required>
                          </div>
                        </div><br>

                        <!-- <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="number" readonly class="form-control"  name="age" placeholder="Age" value="<?php echo $age;?>" required>
                          </div>
                          <div class="col-md-3 " >
                            <select class=" form-control select2" id="gender"  name="gender" value="<?php echo $gender;?>">
                                <option selected="selected">Select Gender</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </select>
                          </div>
                          <div class="col-md-3 " >
                            <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $brgy;?>">
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
                            <input type="text" readonly class="form-control"  name="street" placeholder="Street / Lot # / Block #" value="<?php echo $street;?>" required>
                          </div>
                          
                          <div class="col-md-3 " >
                            <input type="text" readonly class="form-control"  name="city" placeholder ="City / Municipality" value="<?php echo $city;?>" required>  
                          </div>
                          <div class="col-md-3 " >
                            <input type="text" readonly class="form-control"  name="province" placeholder="Province" value="<?php echo $province;?>" required>  
                          </div>
                        </div><br> -->
                    </div>
                </div>
         
                <!-- travel history -->
                <!-- <div class="card">
                  <div class="card-header"><h6>TRAVEL HISTORY</h6></div>
                    <div class="box-body" >
                      <br>
                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <input type="text" readonly class="form-control"  name="city0rigin" placeholder="City of Origin" value="<?php echo $city_origin;?>" required>
                          </div>
                          <div class="col-md-3">
                            <div class="input-group date" data-provide="datepicker" >
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" readonly class="form-control pull-right" id="datepicker" name="date_arrival" placeholder="Date Arrival"  value="<?php echo $now->format('m-d-Y'); ?>">
                            </div>
                          </div>
                        </div><br>

                        <div class="row" >
                          <div class="col-md-1"></div>
                          <div class="col-md-3">
                            <input type="number" readonly class="form-control"  name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number;?>" required>
                          </div>
                         
                          <div class="col-md-3">
                            <select class=" form-control select2" id="travel_days"  name="travel_days" value="<?php echo $travel_days;?>">
                                  <option selected="selected">Traveled during the past 14 days?</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                            </select>
                          </div>
                        </div><br>
                     
                    </div>
                </div> -->
                
                <!--  -->
                <!-- <div class="card">
                  <div class="card-header"><h6>HEALTH HISTORY</h6></div>
                    <div class="box-body" >
                      <br>
                        <div class="row" >
                          <div class="col-md-1"></div>

                          <div class="col-md-3">
                            <input type="text" readonly class="form-control"  name="disease" placeholder="Patient's Disease" value="<?php echo $patient_disease;?>" required>
                          </div>
                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <select class="form-control select2" id="symptoms" style="width: 100%;" name="symptoms" value="<?php echo $symptoms;?>">
                                <option selected="selected">Select Symptoms</option>
                                <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                                <?php } ?>
                            </select>
                          </div>


                          <div class="col-md-3" style="text-algin:center; padding-right:5px;">
                            <select class="form-control select2" id="heath_status" style="width: 100%;" name="health_status" value="<?php echo $health_status;?>">
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
                                <input type="text" readonly class="form-control pull-right" id="datepicker" name="date_process" placeholder="Date Process" 
                                  value="<?php echo $now->format('m-d-Y'); ?>">
                            </div>
                          </div>
                         
                         
                        </div><br>
                     
                    </div>
                </div> -->


                
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
  <!-- /.content-wrapper -->
 <?php include('footer.php')?>

</div>

<!-- add pum modal -->









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
     $('.select2').select2();

    $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true
     
    });

    $('#addPUM').on('hidden.bs.modal', function () {
        $('#addPUM form')[0].reset();
    });

    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });


    $("#btnSubmit").attr("disabled", true);
    $("#name_symptoms").attr("disabled", true);

    $(document).ready(function(){
        $('#btnEdit').click(function() {
          $("input[name='report_date']").removeAttr("readonly");
          $("input[name='report_time']").removeAttr("readonly");
          $("input[name='fullname']").removeAttr("readonly");
          $("input[name='report_date']").removeAttr("readonly");
          $("input[name='status']").removeAttr("readonly");
          $("#name_symptoms").attr("disabled", false);
          $("#btnSubmit").attr("disabled", false);
          $("#btnEdit").attr("disabled", true);
        });
    });

</script>
</body>
</html>
