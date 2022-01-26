<?php


include('../config/db_config.php');
include('insert_sources_infection.php');
session_start();

$now = new DateTime();
$time = date(' H:i');


$entity_no = ' ';

$btnSave = $btnEdit = $patient_no = $date_from = $date_to = '';
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

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

$get_all_bloodtype_sql = "SELECT * FROM type_blood";
$get_all_bloddtype_data = $con->prepare($get_all_bloodtype_sql);
$get_all_bloddtype_data->execute();

$get_all_civilstatus_sql = "SELECT * FROM civil_status";
$get_all_civilstatus_data = $con->prepare($get_all_civilstatus_sql);
$get_all_civilstatus_data->execute();

$get_all_swabbing_sql = "SELECT * FROM reasons_swabbing";
$get_all_swabbing_data = $con->prepare($get_all_swabbing_sql);
$get_all_swabbing_data->execute();

$get_all_admission_sql = "SELECT * FROM place_admission";
$get_all_admission_data = $con->prepare($get_all_admission_sql);
$get_all_admission_data->execute();


$get_all_symptoms_sql = "SELECT * FROM signs_symptoms";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();


$get_all_typequarantine_sql = "SELECT * FROM type_quarantine ";
$get_all_typequarantine_data = $con->prepare($get_all_typequarantine_sql);
$get_all_typequarantine_data->execute();



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

            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content">
                <div class="card">

                    <div class="card-header p-2 bg-success text-white">
                        <div class="nav nav-pills" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-tracer" role="tab" aria-controls="nav-home" aria-selected="true">CONTRACT TRACER</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">CLOSE CONTACT </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">PATIENT PROFILE </a>
                            <a class="nav-item nav-link" id="nav-health-tab" data-toggle="tab" href="#nav-health" role="tab" aria-controls="nav-health" aria-selected="false">HEALTH STATUS</a>
                            <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel" aria-selected="false">TRAVEL HISTORY</a>

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
                                                    <label>Date Registered: </label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" style="width: 90%;" readonly id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <div class="col-md-2">
                                                    <label> Time Registered:</label>
                                                    <input readonly type="text" class="form-control" name="time" id="time" placeholder="Time Registered" value="<?php echo $time; ?>" required>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label>Name of Investigator: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="contact_tracer" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" id="contact_tracer" placeholder="Investigator's Name" value="<?php echo $db_fullname ?>" required>
                                                    <span id="asstdname"> &nbsp;&nbsp;<i>Name of Contact Tracer</i></span>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="col-md-3">
                                                    <label for="">Name of Brgy Contact Tracer: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="brgy_contacttracer" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" id="brgy_contacttracer" placeholder="Name of Brgy Contact Tracer" required>
                                                    <span id="asstdname"> &nbsp; &nbsp;<i>Please put NONE if no Brgy CT assisted</i></span>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">Close Contact?: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <select class=" form-control select2" style="width: 100%;" id="close_contact" name="close_contact" required>
                                                        <option selected="selected">Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <label> Select Individual: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" style="width: 100%;" id="index_name" name=" index_name" value="<?php echo $entity_no ?>">
                                                        <option>Select Individual</option>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label>If YES, who is the Index Case: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" readonly id="index_entity" name="index_entity" placeholder="Index Entity #" >
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="index_case" name="index_case" placeholder="Index Case Name" >
                                                </div>
                                            </div><br>




                                            <div class="row">
                                                <div class="col-md-1"> </div>
                                                <div class="col-md-5">
                                                    <label>If YES, what is your RELATIONSHIP of Index Case: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" id="index_relation" name="index_relation" placeholder="Relationship of Index Case" >
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <label for="">If YES, when was the LAST DAY OF EXPOSURE TO THE CONFIRMED CASE? &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="date" id="date_exposure" name="date_exposure" style="width: 100%;" class="form-control " placeholder="dd/mm/yyyy" value="<?php echo $now->format('Y-m-d'); ?>" />

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label> Select Individual: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" style="width: 90%;" id="entity1" name=" entity_no" value="">
                                                        <option>Select Individual</option>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label for="">Entity ID: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" readonly class="form-control" id="entity_no1" name="entity_no1" placeholder="Entity Number" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Patient #: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" readonly name="patient_no" id="patient_no" placeholder="Patient #" value="<?php echo $patient_no ?>" >
                                                </div>



                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label for="">First Name: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="First Name" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Middle Initial: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="middle_name" id="middle_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Middle Initial" >
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">Last Name: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" style="text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Last Name" >
                                                </div>

                                                <input type="text" hidden readonly class="form-control" id="fullname" name="fullname" placeholder="entity_no" value="" >
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label>Birthdate: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="date" id="birthdate" name="birthdate" onblur="getAge();" value="" class="form-control pull-right " placeholder="dd/mm/yyyy" />
                                                </div>
                                                <div class="col-md-1">
                                                    <label>Age: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="number" id="age" name="age" class="form-control" placeholder="Age" value="">
                                                </div>
                                                <div class=" col-md-2">
                                                    <label for="">Gender: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="gender" name="gender" style=" text-transform: uppercase;" class="form-control" placeholder="Gender" value="">
                                                </div>
                                                <div class=" col-md-3">
                                                    <label for="">Barangay: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="barangay" name="barangay" style=" text-transform: uppercase;" class="form-control" placeholder="Barangay" value="">
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Street/Block #/Lot#: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="street" style=" text-transform: uppercase;" name="street" class="form-control" placeholder="Street" onkeyup="this.value = this.value.toUpperCase();" value="">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">City: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="city" name="city" style=" text-transform: uppercase;" class="form-control" placeholder="City" onkeyup="this.value = this.value.toUpperCase();" value="">

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Province: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="province" name="province" style=" text-transform: uppercase;" class="form-control" placeholder="Province" onkeyup="this.value = this.value.toUpperCase();" value="">

                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Mobile #: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile #" value="" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Civil Status: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class=" form-control select2" style="width: 100%;" id="marital_status" name="marital_status" value="" >
                                                        <option selected="selected">Select Civil Status</option>
                                                        <?php while ($get_civil = $get_all_civilstatus_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_civil['name_civilstatus']; ?>"><?php echo $get_civil['name_civilstatus']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Nationality: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="nationality" id="nationality" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nationality" value="<?php echo $nationality; ?>" >
                                                </div>



                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Blood Type: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class=" form-control select2" style="width: 100%;" id="blood_type" name="blood_type" value="" >
                                                        <option selected="selected">Select Blood Type</option>
                                                        <?php while ($get_blood = $get_all_bloddtype_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_blood['objid']; ?>"><?php echo $get_blood['blood_type']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Occupation: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="occupation" id="occupation" onkeyup="this.value = this.value.toUpperCase();" style="  text-transform: uppercase;" placeholder="Occupation" value="" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Workplace: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="workplace" id="workplace" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Workplace" value="" >

                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">No. of Household Members: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="text" class="form-control" name="household_member" id="household_member" placeholder="No. of Household Members" value="" >
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-health" role="tabpanel" aria-labelledby="nav-health-tab">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-9">
                                                    <label for="">Signs & Symptoms: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" id="symptoms" style="width: 100%;" multiple="" name="signs_symptoms[]" placeholder="Select Symptoms" required>

                                                        <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-9">
                                                    <label for="">Comorbidities: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="comorbidities" onkeyup="this.value = this.value.toUpperCase();" name="comorbidities" style=" text-transform: uppercase;" class="form-control" placeholder="Comorbidites" value="" >

                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label for="">Date of Quarantine started: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="date" id="quaratine_started" name="quaratine_started" style="width: 90%;" class="form-control " placeholder="dd/mm/yyyy"  />
                                                    <span id="asstdname"> &nbsp;&nbsp;<i>If household is on lockdown</i></span>

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Quarantine Type: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" style="width: 90%;" id="quaran123" name="get_type" >
                                                        <option selected>Please select</option>
                                                        <?php while ($get_quarantine = $get_all_typequarantine_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_quarantine['objid']; ?>"><?php echo $get_quarantine['quarantine_name']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>




                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-3">
                                                    <label for="">Place of Origin: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" id="place_orig" style="width: 90%;" name="place_orig" style=" text-transform: uppercase;" class="form-control" placeholder="Place of Origin" value="" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Place of Admission: &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <select class="form-control select2" style="width: 90%;" id="place_admiss" name="place_admiss" value="" >
                                                        <option selected>Please select</option>
                                                        <?php while ($get_admission = $get_all_admission_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_admission['objid']; ?>"><?php echo $get_admission['place_admission']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Date of Admission: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="date" id="date_admiss" style="width: 90%;" name="date_admiss" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                                </div>


                                            </div><br>








                                            <div class="row">
                                                <div class="col-md-1"></div>


                                                <div class="col-md-3">
                                                    <label>Date of Swab Collection: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input type="date" id="date_swab" name="date_swab" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy"  />
                                                </div>



                                                <div class="col-md-3">
                                                    <label for="">Reasons for swabbing?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" style="width: 90%;" id="reasons_swab" name="reasons_swab" value="" >
                                                        <option selected>Please select</option>
                                                        <?php while ($get_swab = $get_all_swabbing_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_swab['objid']; ?>"><?php echo $get_swab['list_swabbing']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>



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

                                    <div class="tab-pane fade" id="nav-travel" role="tabpanel" aria-labelledby="nav-travel-tab">
                                        <div>
                 

                                            <div class="card-body">
                                                <div class="box box-primary">
                                                    <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="col-12" style="margin-bottom:30px;padding:auto;">
                                                                    <div class="input-group date">
                                                                        <div class="col-1"></div>
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

                                                                        <button id="view_person_history" onClick="loadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>
                                                                        <input type="text" hidden id="person_entity" value="<?php echo $entity_no; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">



                                                                <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                                                                    <thead align="center">



                                                                        <th> Trace ID</th>
                                                                        <th> Date/Time</th>
                                                                        <th> NAME</th>
                                                                        <th> Details </th>
                                                                        <th> Contact No. </th>
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