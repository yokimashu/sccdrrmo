<?php

include('../config/db_config.php');



session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}

$now = new DateTime();

$btnSave = $btnEdit = $get_entity_no = $get_username = $get_date_register = $get_firstname = $get_middlename = $get_lastname = $get_birthdate =
$get_age = $get_gender = $get_street =  $get_city =  $get_province =  $get_mobile_no =  $get_telephone_no =  $get_barangay =  $get_email = '';
$btnNew = 'hidden';



$user_id = $_GET['id'];
  $get_individual_sql = "SELECT * FROM tbl_individual WHERE entity_no = :id";
  $get_individual_data = $con->prepare($get_individual_sql);
  $get_individual_data->execute([':id' => $user_id]);
  while ($result = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
    $get_entity_no = $result['entity_no'];
    $get_username = $result['username'];
  
    $get_date_register = $result['date_register'];
    $get_firstname = $result['firstname'];
    $get_middlename = $result['middlename'];
    $get_lastname = $result['lastname'];

    $get_birthdate = $result['birthdate'];
    $get_age = $result['age'];
    $get_gender = $result['gender'];
    $get_street = $result['street'];
    $get_city = $result['city'];
    $get_province = $result['province'];
    $get_mobile_no = $result['mobile_no'];
    $get_telephone_no = $result['telephone_no'];
    $get_barangay = $result['barangay'];
    $get_email = $result['email'];
  


   
  }



$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();



$title = 'VAMOS | Add Individual';


?>


<!DOCTYPE html>
<html>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title; ?></title>
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
        #my_camera {
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

            

            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4>Individual Form</h4>
                    </div>


                    <div class="card-body">

                        <form role="form" enctype="multipart/form-data" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                            <div class="box-body">
                                <div class="row">

                                    <div class="m-1 pb-1"> </div>
                                    <div class="card col-md-6">

                                        <div class=" card-header">
                                            <h6><strong>GENERAL INFORMATION</strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-lg-4">
                                                    <label>Date Registered: </label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $get_date_register; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label>Entity ID : </label>
                                                    <input readonly type="text" class="form-control" name="entity_no" id="entity_no" placeholder="Entity ID" value="<?php echo $get_entity_no;?>" required>
                                                </div>


                                            </div></br>

                                            <div class="row">
                                                    <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <!-- <label>First Name:</label> -->
                                                            <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php echo $get_username; ?>">
                                                        </div>
                                            </div></br>

                            

                                            <div class="row">
                                                    <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <!-- <label>First Name:</label> -->
                                                            <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $get_firstname; ?>">
                                                        </div>
                                            </div></br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <!-- <label>Middle Name:</label> -->
                                                            <input type="text" class="form-control" name="middlename" placeholder="Middle Name" value="<?php echo $get_middlename; ?>">
                                                        </div>
                                                </div></br>

                                                <div class="row">
                                                     <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <!-- <label> Last Name:</label> -->
                                                            <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $get_lastname; ?>">
                                                     </div>
                                            </div><br>

                                            <div class="row">
                                                    <div class="col-md-1"></div>
                                                        <div class="col-md-3">
                                                            <label>Birthdate: </label>
                                                            <div class="input-group date" data-provide="datepicker">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                    <input type="text" class="form-control pull-right" id="datepicker" name="birthdate" placeholder="Date Process" value="<?php echo $get_birthdate; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <label>Age:</label>
                                                                <input type="number" class="form-control" name="age" placeholder="Age" value="<?php echo $get_age; ?>">
                                                        </div>

                                                        <div class="col-md-4">
                                                                <label>Gender:</label>
                                                                <select class=" form-control select2" id="gender" name="gender" value="<?php echo $get_gender; ?>">
                                                                    <option selected="selected">Select Gender</option>
                                                                    <option value="Female">Female</option>
                                                                     <option value="Male">Male</option>
                                                                </select>
                                                        </div>
                                                </div><br>

                                            <div class="row">
                                                        <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <!-- <label>Street: </label> -->
                                                                <input type="text" class="form-control" name="street" placeholder="Street / Lot # / Block #" value="<?php echo $get_street; ?>">
                                                            </div>
                                            </div><br>            

                                            <div class="row">
                                                     <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                <!-- <label>Barangay: </label> -->
                                                                 <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $get_barangay; ?>">
                                                                    <option selected="selected">Select Barangay</option>
                                                                <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $get_brgy['barangay']; ?>"><?php echo $get_brgy['barangay']; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                        <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <!-- <label>Street: </label> -->
                                                                <input type="text" class="form-control" name="city" placeholder= "City" value="SAN CARLOS CITY"<?php echo $get_city; ?>">
                                                            </div>
                                            </div><br>  

                                            <div class="row">
                                                        <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <!-- <label>Street: </label> -->
                                                                <input type="text" class="form-control" name="province" placeholder= "Province" value="NEGROS OCCIDENTAL"<?php echo $get_province; ?>">
                                                            </div>
                                            </div><br> 


                                        </div>
                                                      

                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <div class="card col-md-5">
                                        <div class="card-header">
                                            <h6><strong> ID PHOTO </strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">

                                                    <div stytle ="display: table-cell; vertical-align: middle; height: 50px; border: 1px solid red;" id="my_camera" align ="center" onClick="setup()"> Click to ACCESS Camera</div><br>
                                                   
                                                </div>
                                            </div>

                                            <div class="row" align="center">
                                                <!-- <form method="POST" action="storeImage.php"> -->

                                                    <div class="col-md-3"></div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div>

                                                    <!-- <input type="button" class="btn btn-primary" value="&#9654" onClick="setup()">  -->
                                                    <input type="button" class="btn btn-primary" value="CAPTURE" onClick="take_snapshot()">   
                                                    <input type="button" class="btn btn-danger" value="IMPORT" onClick="take_snapshot()">         
                                
                                                </div>
                                                <!-- </form> -->
                                                </div><br>

                                                <div class="row">
                                                <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <label>CONTACT DETAILS </label>
                                                             
                                                            </div>
                                                                </div><br>
                                               
                                                <div class="row">
                                                        <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <!-- <label>Street: </label> -->
                                                                <input type="text" class="form-control" name="mobile_no" placeholder= "Mobile Number" value="<?php echo $get_mobile_no; ?>">
                                                            </div>
                                                </div></br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <!-- <label>Street: </label> -->
                                                                <input type="text" class="form-control" name="telephone_no" placeholder= "Telephone Number" value="<?php echo $get_telephone_no; ?>">
                                                            </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <!-- <label>Street: </label> -->
                                                                <input type="text" class="form-control" name="email" placeholder= "Email Address" value="<?php echo $get_email; ?>">
                                                            </div>
                                                </div><br>
                                                            
                                                <div class="box-footer" align="center">


<button type="submit" <?php echo $btnSave; ?> name="insert_individual" id="btnSubmit" class="btn btn-success">
    <i class="fa fa-check fa-fw"> </i> </button>

<a href="list_individual.php">
    <button type="button" name="cancel" class="btn btn-danger">
        <i class="fa fa-close fa-fw"> </i> </button>
</a>

<a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no;?>">
    <button type="button" name="print" class="btn btn-primary">
        <i class="nav-icon fa fa-print"> </i> </button>
</a>

                                          
                                    </div>
                                </div>
                            </div>
                        </form>
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
        $('.select2').select2();
        $(document).ready(function() {



            $(document).ajaxStart(function() {
                Pace.restart()
            })

        });
    </script>
<!-- 
    <script>
        function generateID() {

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
    </script> -->


    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        //Webcam.attach( '#my_camera' );
    </script>


    <script language="JavaScript">
        function setup() {
            Webcam.reset();
            Webcam.attach('#my_camera');
        }

        function take_snapshot() {
            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('my_camera').innerHTML =
                    '<img src="' + data_uri + '"/>';
            });
        }
    </script>
</body>

</html>