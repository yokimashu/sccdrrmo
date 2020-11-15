<?php

session_start();

$now = new DateTime();

$entity_no = $date_register = $user_name = $firstname = $middlename = $lastname = $birthdate = $age = $gender = $barangay = $street =
    $city = $province = $mobile_no = $telephone_no = $email = $individual = $individual2 =  $fullname = $entity_no1 = $fullname1 = $photo = '';

$btnSave = $btnEdit = "";
$btnNew = 'hidden';
$btn_enabled = 'enabled';
$img = '';


if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('insert_individual.php');
// include('verify_admin.php');

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

$get_all_individual_sql = "SELECT entity_no,fullname,street,barangay,photo FROM tbl_individual ";
$get_all_individual_data = $con->prepare($get_all_individual_sql);
$get_all_individual_data->execute();

$get_all_individual2_sql = "SELECT entity_no,fullname,street,barangay,mobile_no,photo FROM tbl_individual";
$get_all_individual2_data = $con->prepare($get_all_individual2_sql);
$get_all_individual2_data->execute();

$get_all_individual3_sql = "SELECT entity_no,fullname,street,barangay,mobile_no,photo FROM tbl_individual";
$get_all_individual3_data = $con->prepare($get_all_individual3_sql);
$get_all_individual3_data->execute();

$get_all_individual4_sql = "SELECT entity_no,fullname,street,barangay,mobile_no,photo FROM tbl_individual";
$get_all_individual4_data = $con->prepare($get_all_individual4_sql);
$get_all_individual4_data->execute();

$get_all_individual5_sql = "SELECT entity_no,fullname,street,barangay,mobile_no,photo FROM tbl_individual";
$get_all_individual5_data = $con->prepare($get_all_individual5_sql);
$get_all_individual5_data->execute();

$get_all_individual6_sql = "SELECT entity_no,fullname,street,barangay,mobile_no,photo FROM tbl_individual";
$get_all_individual6_data = $con->prepare($get_all_individual6_sql);
$get_all_individual6_data->execute();



$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
// $photo1 = '1601524087.jpg';

$title = 'VAMOS | COVID-19 Patient Form';
$photo = 'photo1';
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

    <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">
    <!-- <link rel="stylesheet" href="../plugins/pixelarity/jquerysctipttop.css"> -->
    <!-- <link rel="stylesheet" href="../plugins/toastr/toastr.min.css"> -->

    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
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

        .tabs a.active {

            background: lightgreen;

        }

        .nav-link>.active>a {
            color: aqua;
            background-color: chartreuse;
        }

        .nav-item>a:hover {
            color: aqua;
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

                    <div class="card-header p-2 bg-success text-white">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">FORM 1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#profilepicture" data-toggle="tab">FORM 2 </a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">FORM 3</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">

                                    <form action=" ">

                                        <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/entity_multi.php?entity_no=<?php echo $entity_no; ?>&entity_no1=<?php echo $entity_no1; ?>&fullname1=<?php echo $fullname1; ?>&street1=<?php echo $street1; ?>">

                                            <i class="nav-icon fa fa-print"></i></a>
                                        <br>


                                        <!-- //PRINT 1 -->
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <label>PRINT 1: </label>
                                                <select class="form-control select2" id="entity" style="width: 100%;" name="entity" value="<?php echo $entity_no; ?>">
                                                    <option selected="selected">Select Individual</option>
                                                    <?php while ($get_individual = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_individual['entity_no']; ?>"> <?php echo $get_individual['fullname']; ?> <?php echo " - Address: "; ?> <?php echo $get_individual['street']; ?><?php echo " -  Brgy. "; ?>
                                                            <?php echo $get_individual['barangay']; ?><?php; ?><?php echo "-  Photo: "; ?> <?php echo $get_individual['photo']; ?><?php; ?></option>
                                                    <?php } ?>
                                                </select>
                                                            
                                                    <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo1" name="photo" placeholder="photo" value="<?php echo $photo; ?>">
                                                </div>

                                                <div class="card-header">

                                                    <h6><strong> ID PHOTO </strong></h6>
                                                </div>

                                                <div class="box-body">
                                                    <br>
                                                    <div class="row col-12">
                                                        <div class="row">
                                                            <!-- <form method="POST" action="storeImage.php"> -->
                                                            <br>
                                                            <div style="margin:auto; padding-left:12px">

                                                                <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                                                <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
                                                                <!-- <audio id="snapSound"  src="audio/snap.wav"  preload="auto"></audio> -->
                                                                <img src="../flutter/images/<?php echo $photo; ?>" id="photo1" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">
                                                            </div>
                                                        </div>
                                                        <div style="margin:auto">
                                                            <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                                <span class="align-baseline">
                                                                    <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>
                                                          

                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!-- </form> -->
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="entity_no" name="entity_no" placeholder="entity_no" value="<?php echo $entity_no; ?>">
                                                    </div>




                                                    <br>

                                                    <!-- //PRINT 2 -->

                                                    <div class="col-md-1"></div>

                                                    <label>PRINT 2: </label>
                                                    <select class="form-control select2" id="entity2" style="width: 100%;" name="entity" value="<?php echo $entity_no; ?>">
                                                        <option selected="selected">Select Individual</option>
                                                        <?php while ($get_individual2 = $get_all_individual2_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_individual2['entity_no']; ?>"> <?php echo $get_individual2['fullname']; ?> <?php echo " - Address: "; ?> <?php echo $get_individual2['street']; ?><?php echo " - Brgy: ";  ?>
                                                                <?php echo $get_individual2['barangay']; ?><?php; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                    <div hidden>
                                                        <!-- //PRINT 2 TEX FIELDS -->

                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="entity_no1" name="entity_no1" placeholder="entity_no">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="fullname1" name="fullname1" placeholder="fullname1">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="street1" name="street1" placeholder="street1">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="barangay1" name="barangay1" placeholder="barangay1">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="mobile_no1" name="mobile_no1" placeholder="mobile_no1">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="photo1" name="photo1" placeholder="photo1">
                                                        </div>
                                                    </div>


                                                    <br>

                                                    <!-- //PRINT 3 -->

                                                    <div class="col-md-1"></div>

                                                    <label>PRINT 3: </label>
                                                    <select class="form-control select2" id="entity2" style="width: 100%;" name="entity" value="<?php echo $entity_no; ?>">
                                                        <option selected="selected">Select Individual</option>
                                                        <?php while ($get_individual3 = $get_all_individual3_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_individual3['entity_no']; ?>"> <?php echo $get_individual3['fullname']; ?> <?php echo " - "; ?> <?php echo $get_individual2['street']; ?><?php echo " - "; ?></option>
                                                        <?php } ?>
                                                    </select>



                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="entity_no1" name="entity_no1" placeholder="entity_no">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="fullname1" name="fullname1" placeholder="fullname1">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="street1" name="street1" placeholder="street1">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="barangay1" name="barangay1" placeholder="barangay1">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="mobile_no1" name="mobile_no1" placeholder="mobile_no1">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="photo1" name="photo1" placeholder="photo1">
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- 
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label>PRINT 3: </label>
                                                    <select class="form-control select2" id="entity_no" style="width: 100%;" name="individual" value="<?php echo $tracer; ?>" required>
                                                        <option selected="selected">Please Individual</option>
                                                        <?php while ($get_individual = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_individual['fullname']; ?>"></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><br> -->
                                        <!-- 

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label>PRINT 4: </label>
                                                    <select class="form-control select2" id="entity_no" style="width: 100%;" name="individual" value="<?php echo $tracer; ?>" required>
                                                        <option selected="selected">Please Individual</option>
                                                        <?php while ($get_individual = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_individual['fullname']; ?>"></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><br> -->


                                        <!-- 

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label>PRINT 5: </label>
                                                    <select class="form-control select2" id="entity_no" style="width: 100%;" name="individual" value="<?php echo $tracer; ?>" required>
                                                        <option selected="selected">Please Individual</option>
                                                        <?php while ($get_individual = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_individual['fullname']; ?>"></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><br> -->







                                        <!-- 
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-lg-4">
                                                <label>FULL NAME: </label>
                                                <input readonly type="text" class="form-control" name="fullname" id="fullname" placeholder="Entity ID" value="<?php echo $entity_no; ?>" required>
                                            </div>

                                        </div><br> -->



                                    </form>

                                </div>

                                <div class="tab-pane" id="profilepicture">

                                </div>
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
    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        // $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Morris.js charts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <!-- <script src="../plugins/morris/morris.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
    <!-- jvectormap -->
    <!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
    <!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
    <!-- daterangepicker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
    <!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
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
    <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>

    <script src="../plugins/pixelarity/pixelarity-face.js"></script>
    <script src="../plugins/cameracapture/webcam-easy.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- <script type="text/javascript" src="../plugins/cameracapture/photo_template.js"></script> -->
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
    <!-- textarea wysihtml style -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Select2 -->

    <script src="../plugins/select2/select2.full.min.js"></script>


    <!-- Page script -->


    <script language="JavaScript">
        $('.select2').select2();
    </script>



    <script>
        $('#entity').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
                },
                error: function(xhr, b, c) {
                    console.log(
                        "xhr=" +
                        xhr.responseText +
                        " b=" +
                        b.responseText +
                        " c=" +
                        c.responseText
                    );
                },
                success: function(response) {
                    var result = jQuery.parseJSON(response);
                    console.log('response from server', result);
                    $('#entity_no').val(result.data);
                    $('#fullname').val(result.data1);
                    $('#street').val(result.data2);
                    $('#barangay').val(result.data3);
                    $('#mobile_no').val(result.data4);
                    // $('#photo').val(result.data5);
                    $('#photo1').attr("src","../flutter/images/"+result.data5);

                },

            });

        });





        //PRINT 2

        $('#entity2').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
                },
                error: function(xhr, b, c) {
                    console.log(
                        "xhr=" +
                        xhr.responseText +
                        " b=" +
                        b.responseText +
                        " c=" +
                        c.responseText
                    );
                },
                success: function(response) {
                    var result = jQuery.parseJSON(response);
                    console.log('response from server', result);
                    $('#entity_no1').val(result.data);
                    $('#fullname1').val(result.data1);
                    $('#street1').val(result.data2);
                    $('#barangay1').val(result.data3);
                    $('#mobile_no1').val(result.data4);
                    $('#photo1').val(result.data5);

                },


                //   error: function(xhr, b, c) {
                //       console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                //     }
            });

        });





        $(document).ready(function() {
            $('#printlink').click(function() {
                var photo = $('#entity_no').val();
                var entity_no = $('#entity_no').val();
                var entity_no1 = $('#entity_no1').val();
                var fullname1 = $('#fullname1').val();
                var street1 = $('#street1').val();
                var barangay1 = $('#barangay1').val();
                var mobile_no1 = $('#mobile_no1').val();
                var photo1 = $('#photo1').val();
                console.log(entity_no);
                var param = "entity_no=" + entity_no + "&entity_no1=" + entity_no1 + "&fullname1=" + fullname1 + "&street1=" + street1 + "&barangay1=" +
                    barangay1 + "&mobile_no1=" + mobile_no1 + "&photo1=" + photo1 + "";

                $('#printlink').attr("href", "../plugins/jasperreport/entity_multi.php?" + param, '_parent');
            })
        });
    </script>







</body>

</html>