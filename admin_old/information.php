<?php

include('../config/db_config.php');

session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];
}




?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VAMOS | Information </title>
    <?php include('heading.php'); ?>




    <style>
        #information {
            font-size: 25px;
            padding-left: 60px;

        }

        #fbpage:hover {

            background-color: lightgreen;
        }


        #hand-login {
            width: 400px;
            height: 800px;
        }

        #vamos {
            font-size: 40px;

        }


        #itcsologo {
            padding-top: 80px;
            width: 400px;
            height: 500px;
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
                    <div class="card-header bg-success text-white">

                        <h4>VAMOS Information</h4>
                    </div>

                    <div class="card-body">




                        <div class="box-body">

                            <div class="card">
                                <br>

                                <div class="row">
                                    <p id="information" class="col-md-7">


                                        <b> VAMOS or Viral Assessment and Monitoring System</b><br>
                                        is the official contact tracing mobile application of <br>
                                        San Carlos City, Negros Occidental. <br>
                                        <br>

                                        It is a tool designed to register entities such as <br>
                                        individual, juridical and transportation for the monitoring <br>
                                        of their activities for easier and faster contact tracing. <br>

                                        <br>
                                        It uses a QR code techonology. The quick response of <br>
                                        QR Code is a two-dimensional version of the Barcode <br>
                                        able to convey a wide variety of information almost <br>
                                        instantly with just the scan of a mobile device or <br>
                                        smartphones. <br>

                                        <br>


                                        VAMOS is available in both Android and IOS versions <br>
                                        and will be released very soon. <br>

                                        <br>

                                        <br><br><br>



                                    </p>


                                    <div class="col-md-4" style="padding-left:20px">

                                        <img src="../dist/img/PHONE.png" id="hand-login">

                                        <br>
                                        <p>
                                            &nbsp;&nbsp;&nbsp;
                                            Please like our facebook page for more updates: <br>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="https://www.facebook.com/lgusccno.itcso" id="fbpage" target="_blank">
                                                <label>https://facebook.com/lgusccno.itcso</label>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <br><br>







                            </div>


                        </div>









                    </div>

                </div>



            </section>


            <section class="content">
                <div class="card">

                    <div class="card-header bg-success text-white">

                        <h4>ITCSO TEAM</h4>
                    </div>
                    <div class="card-body">

                        <div class="box-body">

                            <div class="card">
                                <br>

                                <div class="row">
                                    <p id="information" class="col-md-7">


                                        <b>Project Manager:</b>
                                        <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                                        Joseph A. Binghay <br>

                                        <br>
                                        <b>Developers: </b><br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Felix Michael F. Oberes<br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Julius M. Mosquera <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Fritz A. Mondero <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Jonard A. Mondero <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Mary Jane B. Elona <br>

                                        <br>
                                        <b>Technical Team:</b> <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Charity P. Madrid <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Jerhod Kyan A. Ricabo <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Gerald B. Diacamos <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; John Rhey R. Martinez <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Ruel Y. Sison <br>
                                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Ariel M. Tañeca <br>

                                    </p>
                                    <div class="col-md-4">

                                        <img src="../dist/img/itcsologo.png" id="itcsologo">
                                        <br>
                                        <p>
                                            &nbsp;&nbsp;&nbsp;
                                            Please like our facebook page for more updates: <br>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="https://www.facebook.com/lgusccno.itcso" id="fbpage" target="_blank">
                                                <label>https://facebook.com/lgusccno.itcso</label>
                                            </a>
                                        </p>



                                    </div>




                                </div>

                                <br><br>
                            </div>
                        </div>
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




</body>

</html>