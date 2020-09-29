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

$btnSave = $btnEdit =  $entity_no = $date_register = $org_type = $org_name = $nature = $street =
$barangay = $city = $province = $contact_person = $contact_position = $mobile_no = $tel_no = $email_address = '';
$btnNew = 'hidden';


$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();



$get_all_category_sql = "SELECT * FROM categ_juridical";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute();

$get_all_nature_sql = "SELECT * FROM nature_of_business ORDER BY name";
$get_all_nature_data = $con->prepare($get_all_nature_sql);
$get_all_nature_data->execute();

$title = 'VAMOS | Juridical Form';


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

            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4>Juridical Form</h4>
                    </div>


                    <div class="card-body">

                        <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">

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
                                                        <input type="text" class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label>Entity ID : </label>
                                                    <input readonly type="text" class="form-control" name="entity_no" id="entity_no" placeholder="Entity ID" value="<?php echo $entity_no; ?>" required>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" id="type" style="width: 100%;" name="type" value="<?php echo $brgy; ?>">
                                                        <option selected="selected">Select Organization Type</option>
                                                        <?php while ($get_categ = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_categ['categ_name']; ?>"><?php echo $get_categ['categ_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                    <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <!-- <label>First Name:</label> -->
                                                            <input type="text" class="form-control" id="username" <?php echo $btn_enabled ?> name="username" placeholder="Username" onblur="checkUsername()" value="<?php echo $user_name; ?>" required>
                                                            <div id="status"></div>
                                                        </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>First Name:</label> -->
                                                    <input type="text" class="form-control" name="org_name" placeholder="Organization/Business Name" value="<?php echo $org_name; ?>" required>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" id="type" style="width: 100%;" name="nature" value="<?php echo $nature; ?>">
                                                        <option selected="selected">Select Nature of Business</option>
                                                        <?php while ($get_nature = $get_all_nature_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_nature['name']; ?>"><?php echo $get_nature['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="street" placeholder="Street / Lot # / Block #" value="<?php echo $street; ?>">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Barangay: </label> -->
                                                    <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $brgy; ?>">
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
                                                    <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $city; ?>">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="province" placeholder="Province" value="<?php echo $province; ?>">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="contact_person" placeholder="Contact Person " value="">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="contact_position" placeholder="Position" value="">
                                                </div>
                                            </div><br>

                                        </div>


                                    </div>&nbsp;&nbsp;&nbsp;

                                    <div class="card col-md-5">
                                        <div class="card-header">
                                            <h6><strong> UPLOAD LOGO </strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">

                                                    <div stytle="display: table-cell; vertical-align: middle; height: 50px; border: 1px solid red;" id="my_camera" align="center" onClick="setup()"></div><br>

                                                </div>
                                            </div>

                                            <div class="row" align="center">
                                                <form method="POST" action="storeImage.php">

                                                    <div class="col-md-3"></div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div>

                                                        <!-- <input type="button" class="btn btn-primary" value="&#9654" onClick="setup()">  -->
                                                        <!-- <input type="button" class="btn btn-primary" value="CAPTURE" onClick="take_snapshot()"> -->
                                                        <input type="button" class="btn btn-danger" value="UPLOAD" onClick="take_snapshot()">

                                                    </div>
                                                </form>
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
                                                    <input type="text" class="form-control" name="mobile_no" placeholder="Mobile Number" value="<?php echo $mobile_no; ?>">
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="telephone_no" placeholder="Telephone Number" value="<?php echo $tel_no; ?>">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $email_address; ?>">
                                                </div>
                                            </div><br>

                                            <div class="box-footer" align="center">


                                                <button type="submit" <?php echo $btnSave; ?> name="insert_juridical" id="btnSubmit" class="btn btn-success">
                                                    <i class="fa fa-check fa-fw"> </i> </button>

                                                <a href="list_juridical.php">
                                                    <button type="button" name="cancel" class="btn btn-danger">
                                                        <i class="fa fa-close fa-fw"> </i> </button>
                                                </a>

                                                <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
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
    </script>


    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
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

        function checkUsername() {
            var username = $('#username').val();
            if(username.length >= 3){
            $("#status").html('<img src="loader.gif" /> Checking availability...');
            $.ajax({
                type: 'POST',
                data: {username:username},
                url: 'check_username.php',
                success: function(data) {
                    $("#status").html(data);
                   
                }
            });
        }
    }
    </script>
</body>

</html>