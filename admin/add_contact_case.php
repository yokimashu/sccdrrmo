<?php



session_start();
include('../config/db_config.php');
include('insert_contactcase.php');
// include('load_history_patient.php');

$now = new DateTime();
$time = date(' H:i');

$patient_no = '';
$entity_no = $date_register = $user_name = $firstname = $middlename = $lastname = $birthdate = $age = $gender = $barangay = $street =
    $city = $province = $mobile_no = $gender = $telephone_no = $email = $individual = $individual2 =  $fullname = $entity_no1 = $fullname1 = $photo = '';

$btnSave = $btnEdit = "";
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

    $db_entity = $result['entity_no'];
    $db_fullname = $result['fullname'];
}



// include('verify_admin.php');

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

$get_all_bloodtype_sql = "SELECT * FROM type_blood";
$get_all_bloddtype_data = $con->prepare($get_all_bloodtype_sql);
$get_all_bloddtype_data->execute();

$get_all_civilstatus_sql = "SELECT * FROM civil_status";
$get_all_civilstatus_data = $con->prepare($get_all_civilstatus_sql);
$get_all_civilstatus_data->execute();


$get_all_symptoms_sql = "SELECT * FROM signs_symptoms";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();


$get_all_typequarantine_sql = "SELECT * FROM type_quarantine ";
$get_all_typequarantine_data = $con->prepare($get_all_typequarantine_sql);
$get_all_typequarantine_data->execute();

$get_all_swabbing_sql = "SELECT * FROM reasons_swabbing";
$get_all_swabbing_data = $con->prepare($get_all_swabbing_sql);
$get_all_swabbing_data->execute();

// $get_all_individual_sql = "SELECT * FROM tbl_individual ";
// $get_all_individual_data = $con->prepare($get_all_individual_sql);
// $get_all_individual_data->execute();


$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
$nationality = ' FILIPINO';


$title = 'VAMOS | Close Contact Form';


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

            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content">
                <div class="card">

                    <div class="card-header p-2 bg-success text-white">

                        <div class="nav nav-pills" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-tracer" role="tab" aria-controls="nav-home" aria-selected="true">TRACER </a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">CLOSE CONTACT </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> PROFILE </a>
                            <a class="nav-item nav-link" id="nav-exposure-tab" data-toggle="tab" href="#nav-exposure" role="tab" aria-controls="nav-exposure" aria-selected="false"> EXPOSURE DETAILS </a>
                            <a class="nav-item nav-link" id="nav-clinical-tab" data-toggle="tab" href="#nav-clinical" role="tab" aria-controls="nav-clinical" aria-selected="false">CLINICAL INFO.</a>
                            <a class="nav-item nav-link" id="nav-history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history" aria-selected="false"> HISTORY</a>
                        </div>
                    </div>



                    <div class="card-body">
                        <div class="box-body">

                            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                                <div class="tab-content" id="nav-tabContent">


                                    <div class="tab-pane fade show active" id="nav-tracer" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label>Date Registered: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" style="width: 90%;" readonly id="datepicker" name="date_register1" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <div class="col-md-2">
                                                    <label> Time Registered: &nbsp;&nbsp; <span id="required">*</span></label>


                                                    <input readonly type="text" class="form-control" name="time" id="time" placeholder="Time Registered" value="<?php echo $time; ?>">
                                                </div>




                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label>Name of Investigator: &nbsp;&nbsp; <span id="required">*</span></label>

                                                    <input type="text" class="form-control" name="contact_tracer" style=" text-transform: uppercase;" id="contact_tracer" placeholder="Investigator's Name" value="<?php echo $db_fullname ?>">
                                                    <span id="asstdname"> &nbsp;&nbsp;<i>Name of Contact Tracer</i></span>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="col-md-3">
                                                    <label for="">Contact No.:</label>
                                                    <input type="text" class="form-control" name="tracer_contactno" style=" text-transform: uppercase;" id="tracer_contactno" placeholder="tracer_contactno" value="">
                                                 
                                                </div>




                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                            
                                          
                                                <div class="col-md-3">
                                                    <label for="">Name of Brgy Contact Tracer: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="brgy_contacttracer" style=" text-transform: uppercase;" id="brgy_contacttracer" placeholder="Name of Brgy Contact Tracer" value="">
                                                    <span id="asstdname"> &nbsp; &nbsp;<i>Please put NONE if no Brgy CT assisted</i></span>
                                                </div>




                                            </div>


                                        </div>

                                    </div>
                                    <!-- TRACER FORM -->
                                    <div class="tab-pane fade show" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                                        <!-- COVID INFO. -->

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">

                                                <label for="">Case of Investigation: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                <select class="form-control select2" style="width: 90%;" id="case_investigation" name="case_investigation" value="">
                                                    <option selected>Please select</option>
                                                    <option value="LOCALLY STRANDED INDIVIDUAL">LOCALLY STRANDED INDIVIDUAL</option>
                                                    <option value="LOCAL TRANSMISSION">LOCAL TRANSMISSION</option>
                                                    <option value="AUTHORIZED PERSON OUTSIDE RESIDENCE">AUTHORIZED PERSON OUTSIDE RESIDENCE</option>
                                                    <option value="CLOSE CONTACT">CLOSE CONTACT</option>
                                                    <option value="NOT APPLICABLE">NOT APPLICABLE</option>
                                                </select>
                                            </div>

                                        </div><br>
                                        <div class="row" id="lsi-form" hidden>
                                            <div class="col-md-1"></div>


                                            <div class="col-md-5">
                                                <label for="">Place of Origin:</label>
                                                <input type="text" class="form-control" id="name_lsi" name="name_lsi" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Place of Origin">
                                            </div>
                                        </div><br>



                                        <div id="cc-form" hidden>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <label>Who is the COVID-19 Patient?: &nbsp;&nbsp;</label>
                                                        <select class="form-control select2" style="width: 100%;" id="index_name" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name=" index_name" value="<?php echo $entity_no ?>">
                                                            <option>Select Individual</option>
                                                        </select>
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>


                                                    <div class="col-md-3">
                                                        <label for="">COVID-19 Patient #: </label>
                                                        <input type="text" readonly class="form-control" id="entity_no" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name="index_no" placeholder="COVID-19 Patient #">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">COVID-19 Patient Full Name: </label>
                                                        <input type="text" class="form-control" id="fullname" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name="patient_name" placeholder="COVID-10 Patient Fullname">
                                                    </div>
                                                </div><br>

                                            </div>

                                        </div>




                                    </div>

                                    <!-- PATIENT PROFILE -->
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <!-- patient information -->
                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>


                                                <label>
                                                    <h5>PERSONAL INFORMATION</h5>
                                                </label>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label> Select Individual: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" id="entity2" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                        <option>Please select...</option>

                                                    </select>


                                                </div>

                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">ENTITY ID: &nbsp;&nbsp; </label>
                                                    <input type="text" readonly class="form-control" id="entity_no7" name="entity_no7" placeholder="Entity #">
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">PATIENT ID: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" readonly class="form-control" id="patient_no" name="patient_no" placeholder="Patient #" value="<?php echo $patient_no ?>">

                                                </div>



                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">FIRSTNAME: </label>

                                                    <input type="text" class="form-control" name="firstname1" id="firstname1" style=" text-transform: uppercase;" placeholder="firstname1">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">MIDDLENAME:</label>
                                                    <input type="text" class="form-control" name="middlename1" id="middlename1" style="text-transform: uppercase;" placeholder="middlename1">
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">LASTNAME:</label>
                                                    <input type="text" class="form-control" name="lastname1" id="lastname1" style="text-transform: uppercase;" placeholder="lastname1">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">FULL NAME: &nbsp;&nbsp; <span id="required">*</span></label>

                                                    <input type="text" class="form-control" name="fullnamess" id="fullnamess" style=" text-transform: uppercase;" placeholder="fullname">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">STREET: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="street" id="street" style="text-transform: uppercase;" placeholder="street">
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">BARANGAY: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="barangay" id="barangay" style="text-transform: uppercase;" placeholder="barangay">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">BIRTH DATE: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="date" id="birthdate" name="birthdate" style="width: 100%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                                </div>

                                                <div class="col-md-1">
                                                    <label for="">AGE: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="age" name="age" value="" class="form-control " placeholder="age" />

                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">GENDER: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="gender" name="gender" value="" class="form-control " placeholder="age" />

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Mobile Number: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" style="text-transform: uppercase;" placeholder="Mobile Number" value="">
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>


                                                <div class="col-md-4">
                                                    <label for="">PERMANENT ADDRESS: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="permanent_add" id="permanent_add" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Permanent Address" value="N/A">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">PERMANENT HOUSE NO.: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="house_no" id="house_no" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Permanent House No." value="N/A">
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4">
                                                    <label for="">Longitude: &nbsp;&nbsp;<span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="longtitude" id="longtitude" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="longitude" value="N/A">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Latitude:&nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="latitude" id="latitude" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder=" latitude" value="N/A">
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-2">
                                                    <label for="">Are you a health worker?:</label>
                                                    <select class="form-control select2" style="width: 100%;" id="healthworker" name="healthworker" value="">
                                                        <option value=" " selected>Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Occupation: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="occupation" id="occupation" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Occupation" value="N/A">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Place of work:&nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="placeofwork" id="placeofwork" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Place of work" value="N/A">
                                                </div>
                                             

                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label for="">Civil Status: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class=" form-control select2" style="width: 100%;" id="patient_civilstatus" name="patient_civilstatus" value="" required>
                                                        <option value=" " selected="selected">Select Civil Status</option>
                                                        <?php while ($get_civil = $get_all_civilstatus_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_civil['name_civilstatus']; ?>"><?php echo $get_civil['name_civilstatus']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Nationality: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" name="nationality" id="nationality" class="form-control" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nationality " value="FILIPINO" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Blood Type: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class=" form-control select2" style="width: 100%;" id="blood_type" name="blood_type" value="" required>
                                                        <option selected="selected">Select Blood Type</option>
                                                        <?php while ($get_blood = $get_all_bloddtype_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_blood['objid']; ?>"><?php echo $get_blood['blood_type']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>

                                            </div><br>







                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Philhealth #: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="phil_no" id="phil_no" style=" text-transform: uppercase;" placeholder="Philhealth Number" value="N/A">
                                                </div>
                                                <div class="cold-md-3">
                                                    <label for="">Passport #: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="passport" id="passport" style=" text-transform: uppercase;" placeholder="Passport Number" value="N/A">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">No. of Household Members: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="household_member" id="household_member" placeholder="No. of Household Members" value="N/A">
                                                </div>




                                            </div><br>
                                        </div>
                                        <br><br>
                                        <!-- outside the philippiens -->
                                        <div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <label for="">ADDRESS OUTSIDE THE PHILIPPINES: </label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" style="width: 100%;" id="ofw" name="ofw" value="">
                                                        <option selected>Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div id="ofw1" hidden>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-2">
                                                        <label for="">(OFW) Employer's Name:</label>
                                                        <input type="text" class="form-control" name="ofw_name" id="ofw_name" style=" text-transform: uppercase;" placeholder="ofw_name" value="N/A">
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Occupation:</label>
                                                        <input type="text" class="form-control" name="ofw_occupation" id="ofw_occupation" style=" text-transform: uppercase;" placeholder="ofw_occupation" value="N/A">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Place of Work:</label>
                                                        <input type="text" class="form-control" name="ofw_placeofwork" id="ofw_placeofwork" style=" text-transform: uppercase;" placeholder="ofw_placeofwork" value="N/A">
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Building Name:</label>
                                                        <input type="text" class="form-control" name="ofw_buidlingname" id="ofw_buidlingname" style=" text-transform: uppercase;" placeholder="ofw_buidlingname" value="N/A">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Street/Subdivision:</label>
                                                        <input type="text" class="form-control" name="ofw_street" id="ofw_street" style=" text-transform: uppercase;" placeholder="ofw_street" value="N/A">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) City:</label>
                                                        <input type="text" class="form-control" name="ofw_city" id="ofw_city" style=" text-transform: uppercase;" placeholder="ofw_city" value="N/A">
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) State:</label>
                                                        <input type="text" class="form-control" name="ofw_state" id="ofw_state" style=" text-transform: uppercase;" placeholder="ofw_state" value="N/A">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Country:</label>
                                                        <input type="text" class="form-control" name="ofw_country" id="ofw_country" style=" text-transform: uppercase;" placeholder="ofw_country" value="N/A">
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Office Phone Number:</label>
                                                        <input type="text" class="form-control" name="ofw_phoneno" id="ofw_phoneno" style=" text-transform: uppercase;" placeholder="ofw_officenumber" value="N/A">
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label for="">(OFW) Office Cellphone Number:</label>
                                                        <input type="text" class="form-control" name="ofw_mobileno" id="ofw_mobileno" style=" text-transform: uppercase;" placeholder="ofw_phoneno" value="N/A">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-exposure" role="tabpanel" aria-labelledby="nav-exposure-tab">
                                        <div>
                                            <div class="row">

                                                <div class="col-md-1"></div>

                                                <div class="col-md-4">

                                                    <label for="">History of exposure to known COVID-19 Case 14 days before the onset of sign and symptoms * </label>
                                                    <select class="form-control select2" style="width: 100%;" id="exposure" name="exposure" value="">
                                                        <option value=" " selected>Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <div id="exposure1" hidden>
                                                        <label for="">If Yes: Date of Contact with known COVID-19 Case: </label>
                                                        <input type="date" id="date_exposure" name="date_exposure" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                                    </div>
                                                </div>
                                            </div><br>

                                            <div class="row">

                                                <div class="col-md-1"></div>

                                                <div class="col-md-4">

                                                    <label for="">Have you been in a place with a known COVID-19 transmission 14 days before the onset of signs and symptoms * </label>
                                                    <select class="form-control select2" style="width: 100%;" id="transmission" name="transmission_name" value="">
                                                        <option value=" " selected>Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>

                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4" id="sample" hidden>
                                                    <label for="">If Yes: Place you have been to </label>
                                                    <select class="form-control select2" style="width: 100%;" id="if_other_transmission" name="other_trans" value="">
                                                        <option value=" " selected>Please select</option>
                                                        <option value="WORK PLACE">WORK PLACE</option>
                                                        <option value="HEALTH FACILITY">HEALTH FACILITY</option>
                                                        <option value="RELIGIOUS GATHERING">RELIGIOUS GATHERING</option>
                                                        <option value="OTHER">OTHER</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4" id="other_choice" hidden>
                                                    <label for="">Others : </label>
                                                    <input type="text" class="form-control" name="name_facility1" id="name_facility1" style=" text-transform: uppercase;" placeholder="Other" value="">

                                                </div>

                                                <div class="col-md-1"></div>

                                                <div class="col-md-4" id="visit_date" name="visit_date" hidden>
                                                    <label for="">Date of Visit : </label>
                                                    <input type="date" id="date_visit" name="date_visit" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                                </div>
                                            </div><br>
                                            <div class="row" id="name_of_place" name="name_of_place" hidden>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4">
                                                    <label for=""> Name of Place </label>
                                                    <input type="text" id="name_place" name="name_place" style=" text-transform: uppercase;" class="form-control" placeholder="Name of place" value="">

                                                </div>

                                            </div><br>



                                            <div id="list_names" name="list_names" hidden>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10 ">
                                                        <label> LIST THE NAMES OF THE PERSON WHO WHERE WITH YOU DURING THIS(THESE) OCCASION(S) AND THEIR CONTACT NUMBERS</label>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">
                                                        <label> PERSON 1 </label>
                                                        <select class="form-control select3" id="person1" style="width: 100%;" name="person1" value=" ">
                                                            <option>Please select...</option>
                                                        </select>
                                                    </div><br>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control  " id="person_entity1" name="person_entity1" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control " id="person_fullname1" name="person_fullname1" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control " id="person_street1" name="person_street1" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control " id="person_barangay1" name="person_barangay1" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control " id="person_mobile1" name="person_mobile1" value="">
                                                    </div>


                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">
                                                        <label> PERSON 2 </label>
                                                        <select class="form-control select2" id="person2" style="width: 100%;" name="person2" value=" ">
                                                            <option>Please select...</option>
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_entity2" name="person_entity2" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_fullname2" name="person_fullname2" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_street2" name="person_street2" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_barangay2" name="person_barangay2" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_mobile2" name="person_mobile2" value="">
                                                    </div>

                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"> </div>
                                                    <div class="col-md-5">
                                                        <label> PERSON 3 </label>
                                                        <select class="form-control select2" id="person3" style="width: 100%;" name="person3" value=" ">
                                                            <option>Please select...</option>

                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="row">

                                                    <div class="col-md-1"></div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_entity3" name="person_entity3" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_fullname3" name="person_fullname3" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_street3" name="person_street3" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_barangay3" name="person_barangay3" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_mobile3" name="person_mobile3" value="">
                                                    </div>

                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">
                                                        <label> PERSON 4 </label>
                                                        <select class="form-control select2" id="person4" style="width: 100%;" name="person4" value=" ">
                                                            <option>Please select...</option>

                                                        </select>
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_entity4" name="person_entity4" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_fullname4" name="person_fullname4" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_street4" name="person_street4" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_barangay4" name="person_barangay4" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_mobile4" name="person_mobile4" value="">
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">

                                                        <label> PERSON 5 </label>
                                                        <select class="form-control select2" id="person5" style="width: 100%;" name="person5" value=" ">
                                                            <option>Please select...</option>

                                                        </select>
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_entity5" name="person_entity5" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_fullname5" name="person_fullname5" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_street5" name="person_street5" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_barangay5" name="person_barangay5" value="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" readonly class="form-control" id="person_mobile5" name="person_mobile5" value="">
                                                    </div>
                                                </div>
                                            </div>





                                            <br>
                                        </div>


                                    </div>








                                    <!-- CLINICAL FORM -->
                                    <div class="tab-pane fade" id="nav-clinical" role="tabpanel" aria-labelledby="nav-clinical-tab">
                                        <div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-9">
                                                    <label for="">Signs & Symptoms: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" id="symptoms" style="width: 100%;" multiple="" name="signs_symptoms[]" placeholder="Select Symptoms">

                                                        <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">

                                                    <label for="">Disposition at the time of report* </label>
                                                    <select class="form-control select2" style="width: 90%;" id="disposition" name="disposition" value="">
                                                        <option selected>Please select</option>
                                                        <option value="INPATIENT">INPATIENT</option>
                                                        <option value="OUTPATIENT">OUTPATIENT</option>
                                                        <option value="DISCHARGED">DISCHARGED</option>
                                                        <option value="DIED">DIED</option>
                                                        <option value="UNKNOWN">UNKNOWN</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-3">
                                                    <label>Date of Onset of Illness: </label>
                                                    <input type="date" id="date_illness" style="width: 90%;" name="date_illness" value="<?php echo $now->format('Y-m-d'); ?>" class="form-control " placeholder="dd/mm/yyyy" />
                                                </div>


                                            </div> <br>


                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Is the HOUSEHOLD/UNIT on LOCKDOWN?:</label>
                                                    <select class="form-control select2" style="width: 90%;" id="lockdown" name="lockdown" value="">
                                                        <option selected>Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3" hidden id="lockdown1-form">
                                                    <label for="">Quarantine Type: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" style="width: 90%;" id="quaran123" name="get_typess">
                                                        <option selected>Please select</option>
                                                        <?php while ($get_quarantine = $get_all_typequarantine_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_quarantine['objid']; ?>"><?php echo $get_quarantine['quarantine_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3" hidden id="lockdown2-form">
                                                    <label for="">Date of Quarantine started: </label>
                                                    <input type="date" id="date_quarans" name="date_quarans" style="width: 100%;" value="<?php echo $now->format('Y-m-d'); ?>" class="form-control " placeholder="dd/mm/yyyy" />

                                                </div>
                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Schedule Swab Date:</label>
                                                    <input type="date" id="sched_date" style="width: 100%;" name="sched_date" value="" class="form-control " placeholder="dd/mm/yyyy" />

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Reasons for swabbing?: </label>
                                                    <select class="form-control select2" style="width: 100%;" id="reasons_swabbing" name="reason_swabbing" value="">
                                                        <option selected>Please select</option>
                                                        <?php while ($get_swab = $get_all_swabbing_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_swab['objid']; ?>"><?php echo $get_swab['list_swabbing']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>


                                            </div><br>









                                        </div>

                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label for="">History of travel/visit/work in other countries with a known COVID-19 Transmission 14 days before the onset of your sign and symptoms *: </label>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">

                                                    <select class="form-control select2" style="width: 100%;" id="travel" name="travel" value="">
                                                        <option selected>Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>

                                                    </select>
                                                </div>
                                            </div><br>

                                            <div id="travel1" hidden>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label for="">Port (Country) of exit: </label>
                                                        <input type="text" class="form-control" name="port_exit" id="port_exit" style=" text-transform: uppercase;" placeholder="port_exit" value="N/A">
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label for="">Airline/Sea Vessel </label>
                                                        <input type="text" class="form-control" name="airline" id="airline" style=" text-transform: uppercase;" placeholder="airline" value="N/A">
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label for="">Flight/Vessel Number </label>
                                                        <input type="text" class="form-control" name="flight_no" id="flight_no" style=" text-transform: uppercase;" placeholder="flight_no" value="N/A">
                                                    </div>

                                                </div><br>





                                            </div>



                                        </div>
                                        <div class="box-footer" align="center">


                                            <button type="submit" <?php echo $btnSave; ?> name="insert_contactcase" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button>

                                            <!-- <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
                                                <button type="button" name="print" class="btn btn-primary">
                                                    <i class="nav-icon fa fa-print"> </i> </button>
                                            </a> -->

                                            <a href="list_close_contact.php">
                                                <button type="button" name="cancel" class="btn btn-danger">
                                                    <i class="fa fa-close fa-fw"> </i> </button>
                                            </a>


                                        </div><br>


                                    </div>

                                    <!-- HISTORY INDIVIDUAL -->
                                    <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
                                        <div>



                                            <div class="card-body">
                                                <div class="box box-primary">
                                                    <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="col-12" style="margin-bottom:30px;padding:auto;">
                                                                    <div class="input-group date">
                                                                        <label style="padding-right:10px;padding-left: 10px">From: </label>
                                                                        <div style="padding-right:10px" class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input style="margin-right:10px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom" value="<?php echo $date_from; ?>">

                                                                        <label style="padding-right:10px">To:</label>
                                                                        <div style="padding-right:10px" class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" style="margin-right:50px;" class="form-control col-3 " data-provide="datepicker" autocomplete="off" name="dateto" id="dteto" value="<?php echo $date_to; ?>">

                                                                        <button onClick="loadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>

                                                                        <input id="entity_no11" value="<?php echo $entity_no11; ?>">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">





                                                                <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                                                                    <thead align="center">



                                                                        <th> Trace ID</th>
                                                                        <th> Date</th>
                                                                        <th> Fullname</th>
                                                                        <th> Details</th>
                                                                        <th> Mobile No.</th>

                                                                    </thead>
                                                                    <tbody id="history_table">

                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                </div>

                            </form>


                        </div>
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

    <!-- generate index  -->
    <script>
        // index name
        // $('#index_name').on('change', function() {
        //     var patient_no = this.value;
        //     console.log(patient_no);
        //     $.ajax({
        //         type: "POST",
        //         url: 'sql_query_get_indexname.php',
        //         data: {
        //             patient_no: patient_no
        //         },
        //         error: functionf(xhr, b, c) {
        //             console.log(
        //                 "xhr=" +
        //                 xhr.responseText +
        //                 " b=" +
        //                 b.responseText +
        //                 " c=" +
        //                 c.responseText
        //             );
        //         },
        //         success: function(response) {
        //             var result = jQuery.parseJSON(response);
        //             console.log('response from server', result);
        //             $('#index_no').val(result.data);
        //             $('#patient_name').val(result.data1);
           

        //         },

        //     });

        // });

        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2();
            $("#index_name").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "patient_query", // json datasource
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

        $('#index_name').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'close_contact.php',
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

               




                },


            });

        });

        // individual
        $('#entity2').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'close_contact.php',
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
                    $('#entity_no7').val(result.data);
                    $('#entity_no11').val(result.data);

                    $('#fullnamess').val(result.data1);
                    $('#street').val(result.data2);
                    $('#barangay').val(result.data3);
                    $('#birthdate').val(result.data4);
                    $('#age').val(result.data5);
                    $('#gender').val(result.data6);
                    $('#mobile_no').val(result.data7);

                    $('#firstname1').val(result.data8);
                    $('#middlename1').val(result.data9);
                    $('#lastname1').val(result.data10);




                },


            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select3').select2();
            $("#entity2").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
        $('#entity2').on('change', function() {

            var entity_no = $(this).val();
            $.ajax({
                type: 'POST',
                data: {
                    entity_no: entity_no
                },
                url: 'generate_closecontact.php',
                success: function(data) {
                    $('#patient_no').val(data);
                }
            });
            //  }
        });
    </script>



    <!--  -->
    <script>
        //PERSON 1
        $(function() {

            //Initialize Select2 Elements
            $('.select3').select2();
            $("#person1").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
        //PERSON 1
        $('#person1').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_index_name.php',
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
                    $('#person_entity1').val(result.data);
                    $('#person_fullname1').val(result.data1);
                    $('#person_street1').val(result.data2);
                    $('#person_barangay1').val(result.data3);
                    $('#person_mobile1').val(result.data4);

                },

            });

        });

        //PERSON 2
        $(function() {
            $('.select4').select2();
            $("#person2").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
        //PERSON 2
        $('#person2').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_index_name.php',
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
                    $('#person_entity2').val(result.data);
                    $('#person_fullname2').val(result.data1);
                    $('#person_street2').val(result.data2);
                    $('#person_barangay2').val(result.data3);
                    $('#person_mobile2').val(result.data4);

                },

            });

        });

        //PERSON 3
        $(function() {
            $('.select4').select2();
            $("#person3").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
        //PERSON 3
        $('#person3').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_index_name.php',
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
                    $('#person_entity3').val(result.data);
                    $('#person_fullname3').val(result.data1);
                    $('#person_street3').val(result.data2);
                    $('#person_barangay3').val(result.data3);
                    $('#person_mobile3').val(result.data4);

                },

            });

        });

        //PERSON 4
        $(function() {
            $('.select4').select2();
            $("#person4").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
        //PERSON 4
        $('#person4').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_index_name.php',
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
                    $('#person_entity4').val(result.data);
                    $('#person_fullname4').val(result.data1);
                    $('#person_street4').val(result.data2);
                    $('#person_barangay4').val(result.data3);
                    $('#person_mobile4').val(result.data4);

                },

            });

        });

        //PERSON 5
        $(function() {
            $('.select4').select2();
            $("#person5").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
        //PERSON 5
        $('#person5').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_index_name.php',
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
                    $('#person_entity5').val(result.data);
                    $('#person_fullname5').val(result.data1);
                    $('#person_street5').val(result.data2);
                    $('#person_barangay5').val(result.data3);
                    $('#person_mobile5').val(result.data4);

                },

            });

        });
    </script>

    <script>
        $('#exposure').change(function() {
            var option = $('#exposure').val();
            if (option == "Yes") {
                $('#exposure1').prop("hidden", false);

            } else {
                $('#exposure1').prop("hidden", true);

            }

            console.log("test");
        });

        $('#transmission').change(function() {
            var option = $('#transmission').val();
            if (option == "Yes") {
                $('#sample').prop("hidden", false);
                $('#visit_date').prop("hidden", false);
                $('#name_of_place').prop("hidden", false);
                $('#list_names').prop("hidden", false);

            } else {
                $('#sample').prop("hidden", true);
                $('#visit_date').prop("hidden", true);
                $('#name_of_place').prop("hidden", true);
                $('#list_names').prop("hidden", true);

                $('#other_choice').prop("hidden", true);
            }


            console.log("test");
        });

        $('#if_other_transmission').change(function() {
            var option = $('#if_other_transmission').val();
            if (option == "OTHER") {
                $('#other_choice').prop("hidden", false);
                $('#visit_date').prop("hidden", true);
                $('#name_of_place').prop("hidden", true);
                $('#list_names').prop("hidden", true);

            }

            console.log("test");
        });
        //mao ni ang select nga id?




        $('#travel').change(function() {
            var option = $('#travel').val();
            if (option == "Yes") {
                $('#travel1').prop("hidden", false);

            } else {
                $('#travel1').prop("hidden", true);

            }

            console.log("test");
        });




        $('#ofw').change(function() {
            var option = $('#ofw').val();
            if (option == "Yes") {
                $('#ofw1').prop("hidden", false);

            } else {
                $('#ofw1').prop("hidden", true);

            }

            console.log("test");
        });




        $('#case_investigation').change(function() {
            var option = $('#case_investigation').val();
            if (option == "CLOSE CONTACT" || option == "AUTHORIZED PERSON OUTSIDE RESIDENCE " || option == "LOCAL TRANSMISSION") {
                $('#cc-form').prop("hidden", false);
                $('#lsi-form').prop("hidden", true);


            } else if (option == "LOCALLY STRANDED INDIVIDUAL") {

                $('#lsi-form').prop("hidden", false);
                $('#cc-form').prop("hidden", true);
            } else {
                $('#lsi-form').prop("hidden", true);
                $('#cc-form').prop("hidden", true);

            }

            console.log("test");
        });

        $('#lockdown').change(function() {
            var option = $('#lockdown').val();
            if (option == "Yes") {
                $('#lockdown1-form').prop("hidden", false);
                $('#lockdown2-form').prop("hidden", false);

            }

            console.log("test");
        });




        // uyes t
        // $('#transmission1').change(function() {
        //     var option = $('#transmission1').val();
        //     if (option == "OTHER") {
        //         $('#OTHER').prop("hidden", false);

        //     } else {
        //         $('#OTHER').prop("hidden", true);

        //     }

        //     console.log("test");
        // });



        function loadhistory() {
            event.preventDefault();
            console.log("test");
            var entity_no = $('#entity_no11').val();

            var date_from = $('#dtefrom').val();
            var date_to = $('#dteto').val();

            $('#history_table').load("load_history_patient.php", {
                    entity_no11: entity_no,
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




        // function loadhistory(){
        //        event.preventDefault();
        //     var entity_no  = $('#entity_no11').val();
        //       var date_from  = $('#dtefrom').val();
        //       var date_to  = $('#dteto').val();

        //     $('#history_table').load("load_history_patient.php",{
        //     entity_no:  entity_no,
        //     date_from :  date_from,
        //     date_to :    date_to},
        //     function(response, status, xhr) {
        //   if (status == "error") {
        //       alert(msg + xhr.status + " " + xhr.statusText);
        //       console.log(msg + xhr.status + " " + xhr.statusText);
        //       console.log("xhr=" + xhr.responseText );
        //     }
        //     });
        //     }

        //    $('#entity_no8').change(function() {
        //             loadhistoy();

        //         });

        // function loadhistory() {
        //     event.preventDefault();
        //     var entity_no = $('#entity_no').val();
        //     var date_from = $('#dtefrom').val();
        //     var date_to = $('#dteto').val();

        //     $('#history_table').load("load_history_patient.php", {
        //             entity_no: entity_no,
        //             date_from: date_from,
        //             date_to: date_to
        //         },
        //         function(response, status, xhr) {
        //             if (status == "error") {
        //                 alert(msg + xhr.status + " " + xhr.statusText);
        //                 console.log(msg + xhr.status + " " + xhr.statusText);
        //                 console.log("xhr=" + xhr.responseText);
        //             }
        //         });
        // }


        // window.onload(loadhistory());
    </script>
</body>

</html>