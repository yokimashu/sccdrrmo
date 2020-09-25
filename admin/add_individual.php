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


$title = 'VAMOS | Add Individual';


?>


<!DOCTYPE html>
<html>
<?php include('heading.php'); ?>

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
                        <h4>Individual Form</h4>
                    </div>


                    <div class="card-body">
                        <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                            <div class="box-body">
                                <div class="row ">
                                    <div class="card col-md-7 ">
                                        <div class="card-header">
                                            <h6>GENERAL INFORMATION</h6>
                                        </div>

                                        <div class="box-body">

                                        </div>



                                    </div> &nbsp;&nbsp;&nbsp;
                                    <div class="card col-sm-4 ">
                                        <div class="card-header">
                                            <h6> ID PHOTO</h6>
                                        </div>
                                        <br>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">

                                                    <div id="my_camera"></div><br>
                                                    <!-- <div id="results">Your captured image will appear here...</div> -->
                                                    <form method="POST" action="storeImage.php">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <input type="button" class="btn btn-primary pull-left" value="Access Camera" onClick="setup(); $(this).hide().next().show();">
                                                            </div> &nbsp; &nbsp;
                                                            <div class="col-sm-2">

                                                                <input type=button class="btn btn-success pull-right" value="Take Snapshot" onClick="take_snapshot()">
                                                            </div>

                                                            <<<<<<< HEAD </div>======= <div class="row">
                                                                <div class="col-12" style="margin-left:180px;margin-right:100px;">
                                                                    <input type="file" name="myFiles" id="fileToUpload" onchange="loadImage()">
                                                                    >>>>>>> 8e46cdd3ffc611e4a4822b4019ed2b695133c5d1

                                                    </form>

                                                </div>

                                            </div>

                                        </div>





                                    </div>


                                </div>
                                <div class="row ">



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
        $(document).ready(function() {

            $('.select2').select2();

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
    </script>

</body>

</html>