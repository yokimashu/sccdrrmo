<?php


include('../config/db_config.php');
// include('insert_sources_infection.php');
session_start();

$now = new DateTime();
$time = date(' H:i');


$entity_no = ' ';

$btnSave = $btnEdit = $pregstatus = $wallergy = $allergy = $wcomorbidities = $comorbidities = $covid_history = $covid_date = $classification = $consent = '';
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



// include('verify_admin.php');

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



$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
$nationality = ' FILIPINO';


$title = 'VAMOS | COVID-19 Patient Form';


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
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>

            <!-- <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div> -->

            <section class="content">
                <div class="card">

                    <div class="card-header p-2 bg-success text-white">
                        <div class="nav nav-pills" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">PROFILE</a>
                            <a class="nav-item nav-link" id="nav-clinic-tab" data-toggle="tab" href="#nav-clinic" role="tab" aria-controls="nav-clinic" aria-selected="false">CLINICAL INFO </a>
                            <a class="nav-item nav-link" id="nav-exposure-tab" data-toggle="tab" href="#nav-exposure" role="tab" aria-controls="nav-exposure" aria-selected="false">EXPOSURE DETAILS</a>
                            <a class="nav-item nav-link" id="nav-attestation-tab" data-toggle="tab" href="#nav-attestation" role="tab" aria-controls="nav-attestation" aria-selected="false">ATTESTATION</a>
                            <!-- <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel" aria-selected="false">TRAVEL HISTORY</a> -->

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="box-body">
                            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                                        <div>
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label for="">Category of the Target Eligible Population:</label>
                                                    <select style="width: 100%;" class="form-control select2">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">ID Number depending on the category type:</label>
                                                    <input type="text" class="form-control" name="patient_no" id="patient_no" placeholder="Enter ID Number" value="">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Philhealth ID:</label>
                                                    <input type="text" class="form-control" name="patient_no" id="patient_no" placeholder="Enter Philhealth ID" value="">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="">Last Name:</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Last Name">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">First Name:</label>
                                                    <input type="text" class="form-control" name="middle_name" id="middle_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="First Name">
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Middle Name:</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Middle Name">
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Suffix:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Contact Number:</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Contact Number">
                                                </div>
                                            </div><br><br>

                                            <div class="row form-group">
                                                <div class="col-md-1"></div>
                                                <label for="">Full Address:</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Unit/Building/House Number:</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Unit/Building/House #">
                                                    <span id="asstdname"> &nbsp;&nbsp;<i>(Street Name, Purok, Zone)</i></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Province:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">Municipality/City:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Barangay:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-2">
                                                    <label for="">Date of Birth:</label>
                                                    <input type="date" class="form-control" name="middle_name" id="middle_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Middle Initial">
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Civil Status:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Employment Status:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Sex:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Profession:</label>
                                                    <select style="width: 100%;" class="form-control">
                                                        <option value="January" selected="selected">Sample Option</option>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label for="">Name of Employer:</label>
                                                    <input type="text" class="form-control" name="middle_name" id="middle_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Name of Employer">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Contact No. of Employer:</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Contact # of Employer">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="">Address of Employer:</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Address of Employer">
                                                </div>
                                            </div><br>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="nav-clinic" role="tabpanel" aria-labelledby="nav-clinic-tab">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label> If female, pregnancy status? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregstatus1" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Pregnant</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregstatus2" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label" for="inlineRadio2">Not Pregnant</label>
                                                    </div>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label>With Allergy? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="allergy1" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="allergy2" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">None</label>
                                                    </div>
                                                </div>
                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-1"> </div>
                                                <div class="col-md-5">
                                                    <label>Name of Allergy &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <textarea class="form-control" id="allergy" name="allergy_name" rows="3" style="width:100%;"></textarea>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label>With Comorbidities? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="comorbidities1" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="comorbidities2" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">None</label>
                                                    </div>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"> </div>
                                                <div class="col-md-5">
                                                    <label>Name of Comorbidities? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <textarea class="form-control" id="comorbidities_id" name="comorbidities_name" rows="3" style="width:100%;"></textarea>
                                                </div>
                                            </div><br>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-exposure" role="tabpanel" aria-labelledby="nav-exposure-tab">

                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label>Patient diagnosed with COVID-19? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="diagnosed1" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="diagnosed2" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">No</label>
                                                    </div>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label>Date of first positive result/ specimen collection? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="date" id="birthdate" name="covid_history" onblur="getAge();" value="" class="form-control pull-right " placeholder="dd/mm/yyyy" />
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label>Classification of infection &nbsp;&nbsp; <span id="required">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Asymptomatic</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Severe</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Mild</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Critical</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Critical</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>



                                    <div class="tab-pane fade" id="nav-attestation" role="tabpanel" aria-labelledby="nav-attestation-tab">
                                        <div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-9">
                                                    <label for="">Are you willing to be vaccinated?: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                            <label class="form-check-label" for="exampleRadios1">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                                            <label class="form-check-label" for="exampleRadios2">
                                                                No
                                                            </label>
                                                        </div>
                                                        <div class="form-check disabled">
                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                                            <label class="form-check-label" for="exampleRadios3">
                                                                Unknown
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-1"></div>

                                            </div><br>




                                        </div>

                                        <div class="box-footer" align="center">


                                            <button type="submit" <?php echo $btnSave; ?> name="insert_sources_infection" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button>

                                            <a href="list_sources_infection">
                                                <button type="button" name="cancel" class="btn btn-danger">
                                                    <i class="fa fa-close fa-fw"> </i> </button>
                                            </a>

                                            <!-- <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
                                                <button type="button" name="print" class="btn btn-primary">
                                                    <i class="nav-icon fa fa-print"> </i> </button>
                                            </a> -->


                                        </div><br>

                                    </div>



                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
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


    <script>
        $('#entity1').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'patient_individual.php',
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
                    $('#person_entity').val(result.data);
                    $('#fullname').val(result.data1);
                    $('#first_name').val(result.data2);
                    $('#middle_name').val(result.data3);
                    $('#last_name').val(result.data4);
                    $('#birthdate').val(result.data5);
                    $('#province').val(result.data6);
                    $('#street').val(result.data7);
                    $('#barangay').val(result.data8);
                    $('#age').val(result.data9);
                    $('#gender').val(result.data10);
                    $('#city').val(result.data11);
                    $('#mobile_no').val(result.data12);
                },
            });

        });

        $('#index_name').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'index_individual.php',
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
                    $('#index_entity').val(result.data);
                    $('#index_case').val(result.data1);

                },


            });
        });


        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2();
            $("#entity1").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query_patient", // json datasource
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },

                    processResults: function(response) {
                        return {
                            results: response


                        };
                    },
                    cache: true,
                    error: function(xhr, b, c) {
                        console.log(
                            "xhr=" +
                            xhr.responseText +
                            " b=" +
                            b.responseText +
                            " c=" +
                            c.responseText
                        );
                    }
                }
            });
            $('#index_name').select2({
                ajax: {
                    url: "individual_query_patient", // json datasource
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },

                    processResults: function(response) {
                        return {
                            results: response


                        };
                    },
                    cache: true,
                    error: function(xhr, b, c) {
                        console.log(
                            "xhr=" +
                            xhr.responseText +
                            " b=" +
                            b.responseText +
                            " c=" +
                            c.responseText
                        );
                    }
                }

            });

        });

        $('#entity1').on('change', function() {

            var entity_no = $(this).val();
            $.ajax({
                type: 'POST',
                data: {
                    entity_no: entity_no
                },
                url: 'generate_patient.php',
                success: function(data) {
                    $('#patient_no').val(data);
                }
            });
            //  }
        });

        function loadhistory() {
            event.preventDefault();
            var entity_no = $('#person_entity').val();
            var date_from = $('#dtefrom').val();
            var date_to = $('#dteto').val();

            $('#history_table').load("load_patient_history.php", {
                    entity_no: entity_no,
                    date_from: date_from,
                    date_to: date_to
                },
                function(response, status, xhr) {
                    if (status == "error") {
                        alert(msg + xhr.status + " " + xhr.statusText);
                        console.log(msg + xhr.status + " " + xhr.statusText);
                        console.log("xhr=" + xhr.responseText);
                    }
                });
        }
    </script>
</body>

</html>