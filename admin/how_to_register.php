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
    <title>VAMOS | Entities & Registration </title>
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

        #icon {
            width: 30px;
            height: 30px;
        }


        #fbpage:hover {

            background-color: lightgreen;
        }


        #text-english {
            font-size: 25px;
            font-weight: normal !important;
            line-height: 1;

        }

        #list-office {
            font-size: 20px;
            padding-left: 110px;
            color: green;
        }

        .logo {
            width: 70px;
            height: 80px;

        }

        .label-logo {
            padding-left: 150px;
            font-size: 13px;
        }

        #content {
            padding-left: 80px;

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
                        <h4>WHAT ARE THE ENTITIES?</h4>

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


                                        <img src="../dist/img/individual.png" alt="" class="logo">
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <img src="../dist/img/juridical.png" alt="" class="logo">
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <img src="../dist/img/transportation.png" alt="" class="logo">
                                        <br>

                                        <p class="label-logo">
                                            &nbsp; &nbsp;&nbsp;
                                            INDIVIDUAL
                                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            JURIDICAL
                                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp; &nbsp;
                                            TRANSPORTATION
                                        </p>

                                        <p id="text-english">
                                            <img src="../dist/img/one.png" id="number">
                                            &nbsp; &nbsp; <b>INDIVIDUAL</b>
                                            <p id="content">
                                                refers to a person or citizen who is a bonafide resident
                                                of San Carlos City or a visitor from the neighboring towns
                                                and cities.

                                            </p>
                                        </p><br>

                                        <p id="text-english">
                                            <img src="../dist/img/two.png" id="number">
                                            &nbsp; &nbsp; <b>JURIDICAL</b>
                                            <p id="content">
                                                refers to organizations which include the following:
                                            </p>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <ul id="list-office">
                                                        <li>Corporation</li>
                                                        <li>Cooperative</li>
                                                        <li>Association</li>
                                                        <li>Religious</li>
                                                        <li>NGO</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-5">

                                                    <ul id="list-office">
                                                        <li>Business</li>
                                                        <li>Foundation</li>
                                                        <li>Partnership</li>
                                                        <li>Government</li>
                                                        <li>School</li>
                                                    </ul>
                                                </div>

                                            </div>

                                        </p><br>


                                        <p id="text-english">
                                            <img src="../dist/img/three.png" id="number">
                                            &nbsp; &nbsp; <b>TRANSPORTATION</b>
                                            <p id="content">
                                                refers to land and sea public transportation which include
                                                the following:
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul id="list-office">
                                                        <li>Bus</li>
                                                        <li>Jeep</li>
                                                        <li>UV Express</li>
                                                        <li>Tricycle</li>
                                                        <li>Motor Habal-habal</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-5">

                                                    <ul id="list-office">
                                                        <li>Motorcab</li>
                                                        <li>Pedicab</li>
                                                        <li>Ship/Ferry</li>
                                                        <li>Motorized Banca</li>
                                                    </ul>
                                                </div>

                                            </div>

                                        </p>










                                    </aside>

                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                                    <div class="col-md-4">
                                        <img src="../dist/img/REGISTRATION.png" alt="" id="hand-login">

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
                        <h4>HOW TO REGISTER AS INDIVIDUAL?</h4>

                    </div>
                    <div class="card-body">
                        <div class="box-body">
                            <div class="card">
                                <br>


                                <div class="row">

                                    <div class="col-md-7">
                                        <p id="information">

                                            <img src="../dist/img/one.png" id="number">
                                            &nbsp;&nbsp;
                                            I click ang REGISTER ug pilion ang INDIVIDUAL
                                        </p><br>

                                        <p id="information">
                                            <img src="../dist/img/two.png" id="number">
                                            Palihog i LOCK usa ang <i> "AUTO ROTATE"</i> sa inyung devices. Makita sa
                                            control center. Iclick <img src="../dist/img/profile-icon.png" id="icon">
                                        </p>






                                    </div>

                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                                    <div class="col-md-4">
                                        <img src="../dist/img/REGISTRATION.png" alt="" id="hand-login">

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
            <br>
        </div>

        <?php include('footer.php'); ?>

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