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
    <title>VAMOS | Download App </title>
    <?php include('heading.php'); ?>




    <style>
        #information {
            font-size: 20px;
            padding-left: 35px;

        }

        #hand-login {
            width: 400px;
            height: 800px;
        }

        #app_label {
            font-size: 25px;
            text-decoration: underline;
        }

        #number {
            width: 50px;
            height: 50px;
        }


        #fbpage:hover {

            background-color: lightgreen;
        }


        #text-english {
            font-size: 20px;
            font-weight: normal !important;
            line-height: 1;

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

                        <h4>How to download?</h4>
                    </div>

                    <div class="card-body">




                        <div class="box-body">

                            <div class="card">

                                <br>

                                <div class="row">
                                    <aside id="information" class="col-md-7">

                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;



                                        <label id="app_label"> FOR IOS (APPLE)</label>
                                        <br><br>

                                        <p id="text-english">
                                            <img src="../dist/img/one.png" id="number">
                                            &nbsp; &nbsp; Open the App Store

                                        </p><br>
                                        <p id="text-english">
                                            <img src="../dist/img/two.png" id="number">
                                            &nbsp; &nbsp; Type VAMOS MOBILE in the search box

                                        </p><br>

                                        <p id="text-english">
                                            <img src="../dist/img/three.png" id="number">
                                            &nbsp; &nbsp; Download and install the VAMOS MOBILE

                                        </p><br>

                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <label id="app_label"> ANDROID (SAMSUNG, HUAWEI, OPPO, VIVO)</label>
                                        <br><br>



                                        <p id="text-english">
                                            <img src="../dist/img/one.png" id="number">
                                            &nbsp; &nbsp; Open Google Chrome or any internet
                                            browser in your phones.

                                        </p><br>

                                        <p id="text-english">
                                            <img src="../dist/img/two.png" id="number">
                                            &nbsp; &nbsp; Type <b>www.sancarloscity.gov.ph</b> in the address bar.

                                        </p><br>
                                        <p id="text-english">
                                            <img src="../dist/img/three.png" id="number">
                                            &nbsp; &nbsp; Click the logo of VAMOS MOBILE to download the installer.

                                        </p><br>

                                        <p id="text-english">
                                            <img src="../dist/img/four.png" id="number">
                                            &nbsp; &nbsp; Open the installer and click install. You need to enable the <br>
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;"Allow installation from unkown sources" in your settings in
                                            <br> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;order to proceed.

                                        </p><br>















                                    </aside>

                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                                    <div class="col-md-4">
                                        <img src="../dist/img/PHONE.png" alt="" id="hand-login">

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