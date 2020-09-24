<?php

include('../config/db_config.php');
include('sql_queries.php');
include('insert_individual.php');
use Endroid\QrCode\QrCode;


session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}

$now = new DateTime();

$btnSave = $btnEdit = $firstname = $middlename = $lastname = $age = $gender =
    $brgy = $street = $city = $province = $city_origin = $date_arrival = $contact_number =
    $travel_days = $patient_disease = $symptoms = $health_status = $id = '';
$btnNew = 'hidden';


$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

?>


<!DOCTYPE html>
<html>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SCCDRRMO ERP | ADD INDIVIDUAL</title>
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
  
    <style>
#my_camera{
 width: 320px;
 height: 240px;
 border: 1px solid black;
}
</style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>

            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4>Registration Form </h4>
                    </div>

                    <div class="card-body">
                        <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                            <div class="box-body">


                                <div class="card">
                                    <div class="card-header">
                                        <h6>Details</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                                <label>Date Registered: </label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text"  class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('m-d-Y'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Entity ID : </label>
                                                <input type="text"  class="form-control" name="entity_no" id="entity_no" placeholder="Entity ID" value="<?php echo $id; ?>" required>
                                            </div>

                                            <div class="container">
                                        <div id="my_camera"></div>
                                        <div id="results">Your captured image will appear here...</div>
                                        </div><br>



                                    </div>
                                </div>


                                <!-- personal information -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6>PERSONAL INFORMATION</h6>

                                        
                                      
    <form method="POST" action="storeImage.php">


<input type=button value="Take Snapshot" onClick="take_snapshot()">

                        </div>
                        <div class ="row">
                        <div class = "col-12" style="margin-left:180px;margin-right:100px;">
                         <input type="file" name="myFiles" id="fileToUpload" onchange = "loadImage()">

                            
                            </div>
                        </div>

                                    
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3" style="text-align:center; padding-right:5px;">
                                                <input type="text"  class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text"  class="form-control" name="middlename" placeholder="Middle Name" value="<?php echo $middlename; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text"  class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" >
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                             
                                                <div class="input-group date" data-provide="datepicker">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text"  class="form-control pull-right" id="datepicker" name="birthdate" placeholder="Date Process" value="<?php echo $now->format('m-d-Y'); ?>">
                                                </div>
                                            </div>
                                            

                                        
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3" style="text-align:center; padding-right:5px;">
                                            
                                                <input type="number"  class="form-control" name="age" placeholder="Age" value="<?php echo $age; ?>" >
                                            </div>
                                            <div class="col-md-3 ">
                                                <select class=" form-control select2" id="gender" name="gender" value="<?php echo $gender; ?>">
                                                    <option selected="selected">Select Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 ">
                                                <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $brgy; ?>">
                                                    <option selected="selected">Select Barangay</option>
                                                    <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_brgy['barangay']; ?>"><?php echo $get_brgy['barangay']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div><br>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3" style="text-align:center; padding-right:5px;">
                                                <input type="text"  class="form-control" name="street" placeholder="Street / Lot # / Block #" value="<?php echo $street; ?>" >
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" readonly class="form-control" name="city" placeholder="City / Municipality" value="SAN CARLOS CITY" >
                                            </div>
                                            <div class="col-md-3 ">
                                                <input type="text" readonly class="form-control" name="province" placeholder="Province" value="NEGROS OCCIDENTAL" >
                                            </div>
                                        </div><br>
                                       
                                    </div>
                                </div>

                                </div>

     



                                <div class="box-footer" align="center">


                                    <button type="submit" <?php echo $btnSave; ?> name="insert_individual" id="btnSubmit" class="btn btn-success">
                                        <i class="fa fa-check fa-fw"> </i> </button>

                                    <a href="add_pum.php">
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


        <?php include('footer.php') ?>

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
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <!-- textarea wysihtml style -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- <script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     -->
     
    <!-- <script src="jpeg_camera/dist/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->
    <script type="text/javascript">

$(document).ready(function() {
   
    $('.select2').select2();

  $(document).ajaxStart(function () {
    Pace.restart()
  })  

});


</script>

<script>
    function generateID(){
       
        $.ajax({
                type: 'POST',
                data: {},
                url: 'generate_id.php',
                success: function(data) {
                    $('#entity_no').val(data);
                }
            });
    }
    window.onload = generateID;
</script>


<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
	</script>
    

	<script language="JavaScript">
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML = 
					'<h2>Here is your image:</h2>' + 
					'<img src="'+data_uri+'"/>';
			} );
		}
	</script>

</body>

</html>