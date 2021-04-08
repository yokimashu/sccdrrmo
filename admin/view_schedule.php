<?php

// session_start();
include('../config/db_config.php');

include('update_schedule.php');

$cbcr = $_SESSION['cbcr'];

$now = new DateTime();
$time = date(' H:i');


$entity_no = ' ';

$btnSave = $btnEdit = $get_entity_no = $get_date = $get_time = $get_cbcr = $get_remarks = $get_firstname =
    $get_middlename = $get_lastname = $get_status = $get_assessment_status = '';

$btnNew = 'hidden';
$btn_enabled = 'enabled';
$time = date('H:i:s');


if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];

$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $tracer_fullname = $result['fullname'];
}


$get_all_gender_sql = "SELECT * FROM tbl_gender";
$get_all_gender_data = $con->prepare($get_all_gender_sql);
$get_all_gender_data->execute();

$get_all_category_sql = "SELECT * FROM tbl_category";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute();

$get_all_category_id_sql = "SELECT * FROM tbl_category_id";
$get_all_category_id_data = $con->prepare($get_all_category_id_sql);
$get_all_category_id_data->execute();

$get_all_civilstatus_sql = "SELECT * FROM civil_status";
$get_all_civilstatus_data = $con->prepare($get_all_civilstatus_sql);
$get_all_civilstatus_data->execute();

$get_all_employment_sql = "SELECT * FROM tbl_employment";
$get_all_employment_data = $con->prepare($get_all_employment_sql);
$get_all_employment_data->execute();

$get_all_profession_sql = "SELECT * FROM tbl_profession";
$get_all_profession_data = $con->prepare($get_all_profession_sql);
$get_all_profession_data->execute();

$get_all_gender_sql = "SELECT * FROM tbl_gender";
$get_all_gender_data = $con->prepare($get_all_gender_sql);
$get_all_gender_data->execute();

$get_all_allergy_sql = "SELECT * FROM tbl_allergy";
$get_all_allergy_data = $con->prepare($get_all_allergy_sql);
$get_all_allergy_data->execute();

$get_all_comorbidities_sql = "SELECT * FROM tbl_comorbidity";
$get_all_comorbidites_data = $con->prepare($get_all_comorbidities_sql);
$get_all_comorbidites_data->execute();

$get_all_healthworkers_sql = "SELECT * FROM tbl_health_workers";
$get_all_healthworkers_data = $con->prepare($get_all_healthworkers_sql);
$get_all_healthworkers_data->execute();

$get_all_infection_sql = "SELECT * FROM tbl_infection";
$get_all_infection_data = $con->prepare($get_all_infection_sql);
$get_all_infection_data->execute();

$get_all_bakuna_center_sql = "SELECT * FROM tbl_bakuna_center";
$get_all_bakuna_center_data = $con->prepare($get_all_bakuna_center_sql);
$get_all_bakuna_center_data->execute();

$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();


// $province = 'NEGROS OCCIDENTAL ';
// $city = 'SAN CARLOS CITY';
$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
$get_employerlgu = 'SAN CARLOS CITY';
$nationality = ' FILIPINO';
$region = 'WESTERN VISAYAS';


$title = 'VAMOS | COVID-19 Update Patient Form';

if (isset($_GET['id'])) {

    $entity_no = $_GET['id'];
    $get_photo_individual = '';
    $get_schedule_sql = "SELECT * from tbl_schedule WHERE entity_no = :id";
    $schedule_data = $con->prepare($get_schedule_sql);
    $schedule_data->execute([':id' => $entity_no]);
    while ($result = $schedule_data->fetch(PDO::FETCH_ASSOC)) {
        $get_entity_no       = $result['entity_no'];
        $get_cbcr            = $result['cbcr'];
        $get_time            = $result['time'];
        $get_date            = $result['date'];
        $get_remarks         = $result['remarks'];
    }

    $get_data_sql = "SELECT * FROM  tbl_entity en INNER JOIN tbl_individual oh ON  oh.entity_no = en.entity_no where oh.entity_no = :id";
    $get_data_data = $con->prepare($get_data_sql);
    $get_data_data->execute([':id' => $entity_no]);

    while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {
        $get_firstname   = $result['firstname'];
        $get_middlename  = $result['middlename'];
        $get_lastname    = $result['lastname'];
        $get_age         = $result['age'];
        $get_email       = $result['email'];
        $get_photo       = $result['photo'];
        $get_status      = $result['status'];
    }
}


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
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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

        #header {
            color: green;
        }

        .nav-link>.active>a {
            color: aqua;
            background-color: chartreuse;
        }

        .nav-item>a:hover {
            color: aqua;
        }

        #required {
            color: red;
        }

        #asstdname {
            font-size: 12px;
        }

        .field_set {
            border-color: green;
            border-style: solid;

        }

        #fieldset-medical {
            color: #31A231;
            width: 23%;
            padding: 5px 15px;

        }

        #fieldset {
            color: #31A231;
            width: 10%;
            padding: 5px 10px;

        }



        #fieldset-category {
            color: #31A231;
            width: 12%;
            padding: 5px 15px;

        }


        #fieldset-basicinfo {
            color: #31A231;
            width: 20%;
            padding: 5px 10px;

        }

        #fieldset_verify {
            color: #31A231;
            width: 15%;
            padding: 5px 10px;

        }

        #fieldset-comorbidity {
            color: #31A231;
            width: 18%;
            padding: 5px 15px;

        }

        #required {
            color: red;
        }

        #asstdname {
            font-size: 12px;
        }

        .btn1 {
            border: none;
            background-color: inherit;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header"></div>


            <section class="content">

                <!-- <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="insert_vaccine.php"> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">


                            <!-- Profile Image -->

                            <?php if ($get_photo == '') {
                                $get_photo = 'user.jpg';
                            } ?>


                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="../flutter/images/<?php echo $get_photo ?>" id="tphoto">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $get_firstname . ' ' . $get_middlename[0] . '.' . ' ' . $get_lastname; ?></h3>

                                    <p class="text-muted text-center"><?php echo $get_entity_no; ?></p>

                                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->


                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <strong><i class="fa fa-calendar"></i> Age</strong>
                                    <p class="text-muted">
                                        <?php echo $get_age; ?></p>
                                    <hr>

                                    <strong><i class="fa fa-envelope"></i> E-mail Address</strong>

                                    <p class="text-muted">
                                        <?php echo $get_email; ?></p>
                                    <hr>


                                    <strong><i class="fa fa-pencil mr-1"></i> Account Status <span id="required">*</span></strong>
                                    <p class="text-muted">
                                        <?php echo $get_status; ?></p>
                                    </p>
                                    <hr>

                                </div>

                                <!-- /.card-body -->
                            </div>

                            <!-- /.card -->
                        </div>


                        <!-- /.col -->
                        <div class="col-md-9">
                            <?php echo $alert_msg; ?>


                            <section class="content">
                                <div class="card">

                                    <div class="card-header bg-success text-white">
                                        <h4>Update Schedule for Vaccine</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="box-body">
                                            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="update_vaccine.php">

                                                <div class="row" hidden>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-2">
                                                        <label>Date Registered: </label>
                                                        <div class="input-group date" data-provide="datepicker">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" readonly class="form-control pull-right" style="width: 90%;" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $get_datecreated; ?>">
                                                        </div>
                                                    </div>
                                                </div>



                                                <!-- first dose -->
                                                    <div class="card card-success card-outline">
                                                        <div class="card-header">
                                                            <h5 class="m-0">FIRST DOSE</h5>
                                                        </div>
                                                        <!-- </legend> -->
                                                        <div class="card-body">

                                                            <div class="row">

                                                                <div hidden class="col-sm-5">
                                                                    <label>Entity Number : &nbsp;&nbsp; <span id="required">*</span></label>
                                                                    <input type="text" readonly class="form-control" id="entity_number" name="entity_number" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity Number" value="<?php echo $get_entity_no; ?>">
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Facility :</label>
                                                                    <select class="form-control select2" style="width: 100%;" name="facility" id="facility">
                                                                        <option selected value="">Select Facility</option>
                                                                        <?php while ($get_bc_center = $get_all_bakuna_center_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                            <?php $selected = ($get_cbcr == $get_bc_center['bc_code']) ? 'selected' : ''; ?>
                                                                            <option <?= $selected; ?> value="<?php echo $get_bc_center['bc_code']; ?>"><?php echo $get_bc_center['bc_name']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div><br>

                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <label>Date of Vaccination: </label>
                                                                    <input type="date" class="form-control" style="width: 100%;" id="datepicker" name="date_sched" placeholder="Schedule Date" value="<?php echo $get_date; ?>">
                                                                </div>


                                                                <!-- time Picker -->
                                                                <div class="col-md-6">
                                                                    <div class="bootstrap-timepicker">
                                                                        <div class="form-group">
                                                                            <label>Time:</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control timepicker" name="time_set" value="<?php echo $get_time; ?>">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.input group -->
                                                                        </div>
                                                                        <!-- /.form group -->
                                                                    </div>

                                                                </div>
                                                            </div><br>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Status:</label>
                                                                    <select name="status" id="status" style="width:100%" class="form-control select2 " value="">
                                                                        <option selected>Please select </option>
                                                                        <option <?php if ($get_remarks == '1st_Dose') echo 'selected'; ?> value="1st_Dose">1ST DOSE </option>
                                                                        <option <?php if ($get_remarks == '2nd_Dose') echo 'selected'; ?> value="2nd_Dose">2ND DOSE </option>
                                                                    </select>

                                                                </div>
                                                            </div><br>



                                                        </div>
                                                    </div>
                                                    
                                                    <!-- end 1st dose -->
                                                

                                                    <!-- 2nd dose -->
                                                    <div class="card card-success card-outline">
                                                        <div class="card-header">
                                                            <h5 class="m-0">SECOND DOSE</h5>
                                                        </div>
                                                        <!-- </legend> -->
                                                        <div class="card-body">

                                                            <div class="row">

                                                                <div hidden class="col-sm-5">
                                                                    <label>Entity Number : &nbsp;&nbsp; <span id="required">*</span></label>
                                                                    <input type="text" readonly class="form-control" id="entity_number" name="entity_number" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity Number" value="<?php echo $get_entity_no; ?>">
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Facility :</label>
                                                                    <select class="form-control select2" style="width: 100%;" name="facility" id="facility">
                                                                        <option selected value="">Select Facility</option>
                                                                        <?php while ($get_bc_center = $get_all_bakuna_center_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                            <?php $selected = ($get_cbcr == $get_bc_center['bc_code']) ? 'selected' : ''; ?>
                                                                            <option <?= $selected; ?> value="<?php echo $get_bc_center['bc_code']; ?>"><?php echo $get_bc_center['bc_name']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div><br>

                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <label>Date of Vaccination: </label>
                                                                    <input type="date" class="form-control" style="width: 100%;" id="datepicker" name="date_sched" placeholder="Schedule Date" value="<?php echo $get_date; ?>">
                                                                </div>


                                                                <!-- time Picker -->
                                                                <div class="col-md-6">
                                                                    <div class="bootstrap-timepicker">
                                                                        <div class="form-group">
                                                                            <label>Time:</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control timepicker" name="time_set" value="<?php echo $get_time; ?>">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.input group -->
                                                                        </div>
                                                                        <!-- /.form group -->
                                                                    </div>

                                                                </div>
                                                            </div><br>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Status:</label>
                                                                    <select name="status" id="status" style="width:100%" class="form-control select2 " value="">
                                                                        <option selected>Please select </option>
                                                                        <option <?php if ($get_remarks == '1st_Dose') echo 'selected'; ?> value="1st_Dose">1ST DOSE </option>
                                                                        <option <?php if ($get_remarks == '2nd_Dose') echo 'selected'; ?> value="2nd_Dose">2ND DOSE </option>
                                                                    </select>

                                                                </div>
                                                            </div><br>



                                                        </div>
                                                    </div>
                                                
                                                <!-- end 2nd dose -->


                                                <div class="box-footer" align="center">


                                                    <button type="submit" id="btnSubmit" name="update_vaccine" class="btn btn-success">
                                                        <!-- <i class="fa fa-check fa-fw"> </i> -->
                                                        <h4>Update Form</h4>
                                                    </button>



                                                </div><br>

                                            </form>
                                        </div>

                                    </div>
                                </div>




                            </section>
                            <br>
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
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <?php

    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status'] ?>",
                // text: "You clicked the button!",
                icon: "<?php echo $_SESSION['status_code'] ?>",
                button: "OK. Done!",
            });
        </script>

    <?php
        unset($_SESSION['status']);
    }
    ?>


    <script language="JavaScript">
        $('.select2').select2();


        $("#name_comorbidities").select2({
            theme: "classic"
        });
    </script>





    <script>
        // $(function() {

        //     $('#update_schedule').on('submit', function() {
        //         var entity_no = this.value;
        //         var n_facility = this.value;
        //         var date_set = this.value;
        //         var time_set = this.value;
        //         var remarks = this.value;
        //         // alert(vaccinator);
        //         console.log(entity_no);
        //         $.ajax({
        //             type: "POST",
        //             url: 'update_schedule.php',
        //             data: {
        //                 entity_no:  entity_no,
        //                 n_facility: n_facility,
        //                 date_set:   date_set,
        //                 time_set:   time_set,
        //                 remarks:    remarks
        //             },
        //             error: function(xhr, b, c) {
        //                 console.log(
        //                     "xhr=" +
        //                     xhr.responseText +
        //                     " b=" +
        //                     b.responseText +
        //                     " c=" +
        //                     c.responseText
        //                 );
        //             },
        //             success: function(response) {
        //                 $('#schedule_form')[0].reset()

        //             },
        //         });

        //     });

        // });
        $(function() {

            // //Timepicker
            // $('#timepicker').datetimepicker({
            //     format: 'LT'
            // })

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })

        });
        $('#category').change(function() {
            var option = $('#category').val();
            //if Senior_Citizen is Selected
            if (option == "02_Senior_Citizen") {
                $('#indigent1').prop("hidden", false);
                $('#healthworker').prop("hidden", true);


            }

            //if Health_Care_Worker is Selected
            if (option == "01_Health_Care_Worker") {
                $('#healthworker').prop("hidden", false);
                $('#indigent1').prop("hidden", true);


            }

            //if 03_Indigent is Selected
            if (option == "03_Indigent") {
                $('#healthworker').prop("hidden", true);
                $('#indigent1').prop("hidden", true);



            }
            //if 04_Uniformed_Personnel is Selected
            if (option == "04_Uniformed_Personnel") {
                $('#healthworker').prop("hidden", true);
                $('#indigent1').prop("hidden", true);



            }

            //if 05_Essential_Worker is Selected
            if (option == "05_Essential_Worker") {
                $('#healthworker').prop("hidden", true);
                $('#indigent1').prop("hidden", true);



            }

            //if 06_Other is Selected
            if (option == "06_Other") {
                $('#healthworker').prop("hidden", true);
                $('#indigent1').prop("hidden", true);



            }





            console.log("test");
        });



        $('#with_allergy').change(function() {
            var option = $('#with_allergy').val();
            if (option == "01_Yes") {
                $('#yes-allergy').prop("hidden", false);



            } else {

                $('#yes-allergy').prop("hidden", true);

            }

            console.log("test");
        });


        $('#with_commorbidities').change(function() {
            var option = $('#with_commorbidities').val();
            if (option == "01_Yes") {
                $('#yes-comordities').prop("hidden", false);



            } else {

                $('#yes-comordities').prop("hidden", true);

            }

            console.log("test");
        });

        $('#profession').change(function() {
            var option = $('#profession').val();
            if (option == "19_Other") {
                $('#indicate').prop("hidden", false);



            } else {

                $('#indicate').prop("hidden", true);

            }

            console.log("test");
        });

        $('#emp_status' && '#name_employeer').change(function() {
            var option1 = $('#emp_status').val();
            var option2 = $('#name_employeer').val();

            if (option1 == "01_Government_Employed" && option2 == "LGU - SAN CARLOS") {
                $('#department').prop("hidden", false);



            } else {

                $('#department').prop("hidden", true);

            }

            console.log("test");
        });

        $('#patient_diagnose').change(function() {
            var option = $('#patient_diagnose').val();
            if (option == "01_Yes") {
                $('#yes-diagnose').prop("hidden", false);



            } else {

                $('#yes-diagnose').prop("hidden", true);

            }

            console.log("test");
        });



        $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
            event.preventDefault();

            var user_id = ($(this).data('id'));

            $('#user_id').val(user_id);
            $('#delete_PUMl').modal('toggle');

        });
    </script>


</body>

</html>