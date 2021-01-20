<?php

session_start();

$now = new DateTime();

$entity_no = $date_register = $user_name = $firstname = $middlename = $lastname = $birthdate = $age = $gender = $barangay = $street = $city = $province = $mobile_no = $telephone_no = $email = '';

$btnSave = $btnEdit = "";
$btnNew = 'hidden';
$btn_enabled = 'enabled';


if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('insert_individual.php');
include('verify_admin.php');

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';


$title = 'VAMOS | Send Message';



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
    <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <script src="https://kit.fontawesome.com/629c6e6cbc.js" crossorigin="anonymous"></script>

    <style>
        #webcam {
            width: 350px;
            height: 350px;
            border: 1px solid black;
        }

        #photo {
            display: block;
            position: relative;
            margin-top: 40px;
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
                        <h4>SEND MESSAGE</h4>
                    </div>


                    <div class="card-body">

                        <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                        <label>From</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input readonly type="text" class="form-control" name="sender_fullname" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" value="<?php echo $db_fullname ?>">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input readonly type="text" class="form-control" name="sender_email" value="">
                                    </div>
                                </div><br>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                        <label>To</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control select2" id="select_receiver" style="width: 100%;" onchange="get_email()" name="receiver_email">
                                            <option selected="selected" value="Choose recipient">Choose</option>

                                        </select>

                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                        <label>Subject</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="email_subject" placeholder="Email Subject" required="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                        <label>Message</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="message" rows="4" cols="50" placeholder="Your message" required></textarea>

                                    </div>
                                </div><br>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer" align="center">

                                <input type="submit" name="send_message" class="btn btn-primary" value="Send Message">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <br>
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
    <script src="../plugins/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/pixelarity/pixelarity-face.js"></script>
    <script src="../plugins/cameracapture/webcam-easy.min.js"></script>

    <script src="../plugins/select2/select2.full.min.js"></script>





    <script language="JavaScript">
        $('.select2').select2();
    </script>
</body>

</html>