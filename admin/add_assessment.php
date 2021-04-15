<?php


include('../config/db_config.php');
// include('update_assessment.php');
session_start();

$cbcr = $_SESSION['cbcr'];
date_default_timezone_set('Asia/Manila');
// 
// date_default_timezone_set("America/New_York");
// echo "The time is " . date("h:i:sa");
$now = new DateTime();
// $time = date('H:i');

// $time = date("h:i:sa");

$entity_no = ' ';

$btnSave = $btnEdit = $get_entity_no = $get_age = $get_status = $get_email = $get_photo =
    $get_firstname = $get_middlename = $get_lastname = $get_suffix = $pregstatus = $wallergy =
    $allergy = $wcomorbidities = $comorbidities = $covid_history = $covid_date = $classification = $get_consent =
    $refusal = $age_16 = $allergy_PEG = $allergic_reaction = $no_food_allergy = $monitor_patient = $bleeding_history = $yes_bleeding_history =
    $manifest_symptoms = $specify_symptoms = $no_exposure = $no_treated = $no_received_vaccine = $no_received_antibodies = $pregnant_semester =
    $no_illness = $specify_illness = $medical_clearance = $deferral = $vaccination_date = $vaccine_manufacturer = $batch_number = $lot_number =
    $vaccinator_name = $profession_vaccinator = $dose_1st = $dose_2nd = '';
$btnNew = 'hidden';
$btn_enabled = 'enabled';
$img = '';
$alert_msg = '';


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

if (isset($_GET['id'])) {

    $entity_no = $_GET['id'];
    $get_photo_individual = '';
    $get_vaccineProfile_sql = "SELECT * FROM tbl_assessment a inner join tbl_vaccine v on v.entity_no = a.entity_no WHERE a.objid = :id";
    $vaccineprofile_data = $con->prepare($get_vaccineProfile_sql);
    $vaccineprofile_data->execute([':id' => $entity_no]);
    while ($result = $vaccineprofile_data->fetch(PDO::FETCH_ASSOC)) {
        $get_objid       = $result['objid'];
        $get_entity_no       = $result['entity_no'];
        $get_datecreated    = $result['datecreate'];
        $get_timereg        = $result['time_reg'];
        $get_category       = $result['Category'];
        $get_categoryid     = $result['CategoryID'];
        $get_categoryno     = $result['CategoryIDnumber'];
        $get_healthworker   = $result['HealthWorker'];
        $get_philhealth     = $result['PhilHealthID'];
        $get_pwdID          = $result['PWD_ID'];
        $get_lastname       = $result['Lastname'];
        $get_firstname      = $result['Firstname'];
        $get_middlename     = $result['Middlename'];
        $get_suffix         = $result['Suffix'];
        $get_mobile_no     = $result['Contact_no'];
        $get_gender         = $result['Sex'];
        $get_birthdate      = $result['Birthdate_'];
        $get_civil_status   = $result['Civilstatus'];
        $get_employed      = $result['Employed'];
        $get_profession     = $result['Profession'];
        $get_barangay       = $result['Barangay'];
        $get_province       = $result['Province'];
        $get_region         = $result['Region'];
        $get_street         = $result['Full_address'];
        $get_city           = $result['MunCity'];


        // $get_directcovid    = $result['Direct_covid'];
        $get_employername   = $result['Employer_name'];
        $get_employeraddress = $result['Employer_address'];
        $get_employercontact = $result['Employer_contact_no'];
        $get_employerlgu    = $result['Employer_LGU'];
        $get_pregstatus     = $result['Preg_status'];
        $get_wallergy       = $result['W_allergy'];
        $get_wcomorbidities = $result['W_comorbidities'];

        // name of allergies
        $get_allergy01      = $result['Allergy_01'];
        $get_allergy02      = $result['Allergy_02'];
        $get_allergy03      = $result['Allergy_03'];
        $get_allergy04      = $result['Allergy_04'];
        $get_allergy05      = $result['Allergy_05'];
        $get_allergy06      = $result['Allergy_06'];
        $get_allergy07      = $result['Allergy_07'];
        $get_allergy08      = $result['Allergy_08'];

        // name of comorbidities
        $get_comorbidity01  =  $result['Comorbidity_01'];
        $get_comorbidity02  =  $result['Comorbidity_02'];
        $get_comorbidity03  =  $result['Comorbidity_03'];
        $get_comorbidity04  =  $result['Comorbidity_04'];
        $get_comorbidity05  =  $result['Comorbidity_05'];
        $get_comorbidity06  =  $result['Comorbidity_06'];
        $get_comorbidity07  =  $result['Comorbidity_07'];
        $get_comorbidity08  =  $result['Comorbidity_08'];


        $get_covidhistory   = $result['covid_history'];
        $get_directcovid    = $result['Direct_covid'];
        $get_coviddate      = $result['covid_date'];
        $get_covidclass     = $result['covid_classification'];
        $get_consent        = $result['Consent'];
        $get_sinovac        = $result['sinovac'];
        $get_astrazeneca    = $result['astrazeneca'];


        //table assessment
        $consent            = $result['consent'];
        $age_16             = $result['MoreThan16yo'];
        $allergy_PEG        = $result['PegPolysorbate'];
        $wallergy           = $result['AllergyToFood'];
        $monitor_patient    = $result['MonitorAllergy'];
        $allergic_reaction  = $result['Severe_Reaction'];
        $no_exposure        = $result['CovidHistory'];
        $no_treated         = $result['CovidTreated'];
        $no_received_antibodies = $result['AntibodiesCovid'];
        $bleeding_history   = $result['BleedingHistory'];
        $yes_bleeding        = $result['BleedingDisorders'];
        $no_received_vaccine = $result['ReceivedVaccine'];
        $symptoms           = $result['ManifestSymptoms'];
        $illness            = $result['Illness'];
        $clearance          = $result['MedicalClearance'];
        $semester           = $result['PregnantSemester'];
        $deferral           = $result['Deferral'];
        $vaccine_manufacturer = $result['VaccineManufacturer'];
        $batch_number       = $result['BatchNumber'];
        $lot_number         = $result['LotNumber'];
        $get_vaccinator_name     = $result['VaccinatorName'];
        $profession_vaccinator   = $result['VaccinatorProfession'];
        $vaccination_date = $result['DateVaccination'];
        $dose_1st         = $result['1stDose'];
        $dose_2nd         = $result['2ndDose'];
    }

    $get_data_sql = "SELECT * FROM  tbl_entity en INNER JOIN tbl_individual oh ON  oh.entity_no = en.entity_no where oh.entity_no = :id";
    $get_data_data = $con->prepare($get_data_sql);
    $get_data_data->execute([':id' => $entity_no]);

    while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {



        $get_age = $result['age'];

        $get_email = $result['email'];
        $get_photo = $result['photo'];
        $get_status = $result['status'];
    }
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

$get_all_gender_sql = "SELECT * FROM tbl_gender";
$get_all_gender_data = $con->prepare($get_all_gender_sql);
$get_all_gender_data->execute();

$get_all_allergy_sql = "SELECT * FROM tbl_allergy";
$get_all_allergy_data = $con->prepare($get_all_allergy_sql);
$get_all_allergy_data->execute();

$get_all_comorbidities_sql = "SELECT * FROM tbl_comorbidity";
$get_all_comorbidites_data = $con->prepare($get_all_comorbidities_sql);
$get_all_comorbidites_data->execute();

$get_all_infection_sql = "SELECT * FROM tbl_infection";
$get_all_infection_data = $con->prepare($get_all_infection_sql);
$get_all_infection_data->execute();

$get_all_healthworkers_sql = "SELECT * FROM tbl_health_workers";
$get_all_healthworkers_data = $con->prepare($get_all_healthworkers_sql);
$get_all_healthworkers_data->execute();

$get_all_complications_sql = "SELECT * FROM tbl_complications";
$get_all_complications_data = $con->prepare($get_all_complications_sql);
$get_all_complications_data->execute();

$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms_covid";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();

$get_all_reason_sql = "SELECT * FROM tbl_reason";
$get_all_reason_data = $con->prepare($get_all_reason_sql);
$get_all_reason_data->execute();

$get_all_deferral_sql = "SELECT * FROM tbl_deferral";
$get_all_deferral_sql = $con->prepare($get_all_deferral_sql);
$get_all_deferral_sql->execute();

$get_all_manufacturer_sql = "SELECT * FROM tbl_manufacturer";
$get_all_manufacturer_sql = $con->prepare($get_all_manufacturer_sql);
$get_all_manufacturer_sql->execute();


$get_all_vaccinator_sql = "SELECT * FROM tbl_vaccinators where n_facility = :cbcr";
$get_all_vaccinator_sql = $con->prepare($get_all_vaccinator_sql);
$get_all_vaccinator_sql->execute([':cbcr' => $cbcr]);



$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
$nationality = ' FILIPINO';
$region = 'WESTERN VISAYAS';
$lgu = 'SAN CARLOS CITY';


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

        .field_set {
            border-color: green;
            border-style: solid;

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

        #fieldset-medical {
            color: #31A231;
            width: 23%;
            padding: 5px 15px;

        }

        #fieldset-comorbidity {
            color: #31A231;
            width: 18%;
            padding: 5px 15px;

        }

        #fieldset-basicinfo {
            color: #31A231;
            width: 20%;
            padding: 5px 15px;

        }

        #fieldset_verify {
            color: #31A231;
            width: 15%;
            padding: 5px 10px;

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





            <!-- Main content -->
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

                                    <h2 class="profile-username text-center"><?php echo $get_firstname . ' ' . $get_middlename[0] . '.' . ' ' . $get_lastname . ' ' . $get_suffix; ?></h2>

                                    <p class="text-muted text-center"><?php echo $get_entity_no; ?></p>


                                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->


                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Basic Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <strong><i class="fa fa-calendar"></i> Birthdate</strong>
                                    <p class="text-muted">
                                        <?php echo $get_birthdate; ?></p>
                                    <hr>

                                    <strong><i class="fa fa-calendar"></i> Age</strong>
                                    <p class="text-muted">
                                        <?php echo $get_age; ?></p>
                                    <hr>

                                    <strong><i class="fa fa-calendar"></i> Civil Status</strong>
                                    <p class="text-muted">
                                        <?php echo $get_civil_status; ?></p>
                                    <hr>

                                    <strong><i class="fa fa-calendar"></i> Contact No.</strong>
                                    <p class="text-muted">
                                        <?php echo $get_mobile_no; ?></p>
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

                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Actions</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <strong><i class="fa fa-pencil mr-1"></i> <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?> " target="_blank" title="Vamos ID"> Print Vamos ID </a> </strong>

                                    <p class="text-muted">

                                        <hr>
                                        <strong><i class="fa fa-pencil mr-1"></i> <a href="../plugins/jasperreport/vaccineform.php?entity_no=<?php echo $entity_no; ?> " target="_blank" title="Vaccine Form"> Print Vaccination Form </a> </strong>


                                    <p class="text-muted">

                                        <hr>


                                        <strong><i class="fa fa-pencil mr-1"></i> <a href="../plugins/jasperreport/vaccination_card.php?entity_no=<?php echo $entity_no; ?> " target="_blank" title="Vaccination Card"> Print Vaccination Card </a> </strong>


                                    <p class="text-muted">

                                    </p>


                                    <hr>


                                    <!-- <strong><i class="fa fa-pencil mr-1"></i> <a href="update_assessment.php?entity_no=<?php echo $entity_no; ?> "> View VAS </a> </strong>


                                    <p class="text-muted">

                                    </p>
                                    <hr> -->

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
                                        <h4>Vaccine Assessment and Screening (VAS)</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="box-body">
                                            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="update_assessment.php">

                                                <div class="row" hidden >
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-2">
                                                        <label>Date Registered: </label>
                                                        <div class="input-group date" data-provide="datepicker">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" readonly class="form-control pull-right" style="width: 90%;" id="datepicker" name="date_reg" placeholder="Date Process" value="<?php echo date('Y-m-d'); ?>">
                                                            <input type="text" readonly class="form-control pull-right" style="width: 90%;" id="objid" name="objid" placeholder="Objid" value="<?php echo $get_objid; ?>">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <label> Time Registered:</label>
                                                        <input readonly type="text" class="form-control" style="text-align:center;" name="time_reg" id="time" placeholder="Time Registered" value="<?php echo $get_timereg; ?>">
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-5">
                                                            <label>Entity Number : &nbsp;&nbsp; <span id="required">*</span></label>
                                                            <input type="text" readonly class="form-control" id="entity_number" name="entity_number" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity Number" value="<?php echo $get_entity_no; ?>">
                                                        </div>

                                                    </div><br>


                                                </div>



                                                <!-- address -->


                                                <!-- </fieldset><br> -->
                                                <!-- end of address -->

                                                <!--pregnancy status-->
                                                <div hidden class="card card-success card-outline">
                                                    <div class="card-header">
                                                        <h5 class="m-0">PREGNANCY STATUS</h5>
                                                    </div>
                                                    <div class="card-body">

                                                    </div>
                                                </div>
                                                <!-- end pregnancy status -->


                                                <!-- start of consent -->
                                                <div class="card card-success card-outline">
                                                    <div class="card-header">

                                                        <h5 class="m-0">CONSENT</h5>
                                                    </div>

                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Willing to be vaccinated? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                                <select class="form-control select2" name="electronic_consent" id="electronic_consent" value="">
                                                                    <!-- <option value="01_Yes">Yes</option> -->
                                                                    <option>Please select</option>
                                                                    <option <?php if ($consent == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                    <option <?php if ($consent == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                </select>
                                                            </div>

                                                            <?php if ($get_consent == '02_No') { ?>
                                                                <div id="reason_refusal" class="col-md-6">
                                                                <?php } else { ?>
                                                                    <div hidden id="reason_refusal" class="col-md-6">
                                                                    <?php } ?>

                                                                    <label for="">Reason for refusal</label>
                                                                    <select class="form-control select2" id="refusal" style="width: 100%;" name="refusal" placeholder="" value="<?php echo $refusal; ?>">
                                                                        <option selected value="">Choose here</option>
                                                                        <?php while ($get_reason = $get_all_reason_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                            <option value="<?php echo $get_reason['reason']; ?>"><?php echo $get_reason['reason']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    </div>


                                                                </div>

                                                        </div>
                                                    </div>
                                                    <!-- end of consent -->



                                                    <div class="card">

                                                        <div class="card-header p-2 card-success card-outline">
                                                            <div class="nav nav-pills" id="nav-tab" role="tablist">
                                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-allergy" role="tab" aria-controls="nav-home" aria-selected="true">ALLERGY INFORMATION</a>
                                                                <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab" aria-controls="nav-other" aria-selected="false">MEDICAL INFORMATION</a>
                                                                <a class="nav-item nav-link" id="nav-covid-tab" data-toggle="tab" href="#nav-covid" role="tab" aria-controls="nav-covid" aria-selected="false">COVID INFORMATION</a>
                                                                <a class="nav-item nav-link" id="nav-pregnancy-tab" data-toggle="tab" href="#nav-pregnancy" role="tab" aria-controls="nav-pregnancy" aria-selected="false">PREGNANCY STATUS</a>
                                                            </div>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="box-body">
                                                                <div class="tab-content" id="nav-tabContent">

                                                                    <div class="tab-pane fade show active" id="nav-allergy" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                        <div>


                                                                            <div class="row">
                                                                                <div class="col-sm-7">
                                                                                    <label>Has no allergies to PEG or polysorbate?</label>
                                                                                </div>
                                                                                <div class="col-sm-2"></div>
                                                                                <div class="col-sm-3">
                                                                                    <select class="form-control select2" style="width:100%" name="allergy_PEG" id="allergy_PEG" value="">
                                                                                        <!-- <option>Do you have comorbidities?</option> -->
                                                                                        <option>Please select</option>
                                                                                        <option <?php if ($allergy_PEG == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                        <option <?php if ($allergy_PEG == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div><br>

                                                                            <div class="row">
                                                                                <div class="col-sm-7">
                                                                                    <label>Has no allergy to food, egg, medicines, and no asthma?</label>
                                                                                </div>
                                                                                <div class="col-sm-2"></div>
                                                                                <div class="col-sm-3">
                                                                                    <select class="form-control select2" style="width:100%" name="food_allergy" id="food_allergy" value="">
                                                                                        <!-- <option>Do you have comorbidities?</option> -->
                                                                                        <option <?php if ($wallergy == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                        <option <?php if ($wallergy == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div><br>

                                                                            <?php if ($wallergy == '02_No') { ?>
                                                                                <div class="row" id="allergic">
                                                                                <?php } else { ?>
                                                                                    <div hidden class="row" id="allergic">
                                                                                    <?php } ?>

                                                                                    <div class="col-sm-7">
                                                                                        <label>* If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-2"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="monitor_patient" id="monitor_patient" value="">
                                                                                            <!-- <option>Do you have comorbidities?</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($monitor_patient == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($monitor_patient == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    </div><br>

                                                                                    <div class="row">
                                                                                        <div class="col-sm-7">
                                                                                            <label>Has no severe allergic reaction after the 1st dose of the vaccine?</label>
                                                                                        </div>
                                                                                        <div class="col-sm-2"></div>
                                                                                        <div class="col-sm-3">
                                                                                            <select class="form-control select2" style="width:100%" name="allergic_reaction" id="allergic_reaction" value="">
                                                                                                <!-- <option>Do you have comorbidities?</option> -->
                                                                                                <option>Please select</option>
                                                                                                <option <?php if ($allergic_reaction == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                                <option <?php if ($allergic_reaction == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>


                                                                                </div>

                                                                        </div>


                                                                        <div class="tab-pane fade" id="nav-covid" role="tabpanel" aria-labelledby="nav-covid-tab">
                                                                            <div>


                                                                                <div class="row">
                                                                                    <div class="col-sm-7">
                                                                                        <label style="font-size:14px">Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-2"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="covid_exposure" id="covid_exposure" value="">
                                                                                            <!-- <option>Choose here</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($no_exposure == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($no_exposure == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>


                                                                                <div class="row">
                                                                                    <div class="col-sm-7">
                                                                                        <label style="font-size:14px">Has not been previously treated for COVID-19 in the past 90 days?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-2"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="covid_treated" id="covid_treated" value="">
                                                                                            <!-- <option>Choose here</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($no_treated == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($no_treated == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>


                                                                                <div class="row">
                                                                                    <div class="col-sm-7">
                                                                                        <label style="font-size:14px">Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-2"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="covid_antibody" id="covid_antibody" value="">
                                                                                            <!-- <option>Choose here</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($no_received_antibodies == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($no_received_antibodies == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                            </div>
                                                                        </div>

                                                                        <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">

                                                                            <div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                        <label style="font-size:14px">Age more than 16 years old?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="age_16" id="age_16" value="">
                                                                                            <!-- <option>Do you have comorbidities?</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($age_16 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($age_16 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                        <label style="font-size:14px">Has no history of bleeding disorders or currently taking anti-coagulants?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="bleeding_history" id="bleeding_history" value="">
                                                                                            <!-- <option>Do you have comorbidities?</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($bleeding_history == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($bleeding_history == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div hidden class="col-sm-8" id="bleeding">
                                                                                        <label style="font-size:14px">* If with bleeding history, is a gauge 23 - 25 syringe available for injection?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div hidden class="col-sm-3" id="bleeding1">
                                                                                        <select class="form-control select2" style="width:100%" name="yes_bleeding" id="yes_bleeding" value="">
                                                                                            <!-- <option>Do you have comorbidities?</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($yes_bleeding == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($yes_bleeding == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                        <label style="font-size:14px">Has not received any vaccine in the past 2 weeks?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="no_received_vaccine" id="no_received_vaccine" value="">
                                                                                            <!-- <option>Choose here</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($no_received_vaccine == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($no_received_vaccine == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                        <label style="font-size:14px">Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat, Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="manifest_symptoms" id="manifest_symptoms" value="">
                                                                                            <!-- <option>Do you have comorbidities?</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($symptoms == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($symptoms == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div hidden class="col-sm-8" id="symptoms">
                                                                                        <label style="font-size:14px" for="">* If manifesting any of the mentioned symptom/s, specify all that apply</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div hidden class="col-sm-3" id="symptoms1">
                                                                                        <select class="form-control select2" id="symptoms" style="width: 100%;" multiple="" name="list_symptoms[]" placeholder="">

                                                                                            <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                                <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                        <label style="font-size:14px">Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div class="col-sm-3">
                                                                                        <select class="form-control select2" style="width:100%" name="no_illness" id="no_illness" value="">
                                                                                            <!-- <option>Choose here</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($illness == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($illness == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="row">
                                                                                    <div hidden class="col-sm-8" id="illness">
                                                                                        <label style="font-size:14px" for="">* If manifesting any of the mentioned symptom/s, specify.</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div hidden class="col-sm-3" id="illness1">
                                                                                        <select class="form-control select2" id="complications" style="width: 100%;" multiple="" name="list_illness[]" placeholder="Select Illness" value="">
                                                                                            <!-- <option selected>Choose here...</option> -->
                                                                                            <?php while ($get_complications = $get_all_complications_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                                <option value="<?php echo $get_complications['complications']; ?>"><?php echo $get_complications['complications']; ?></option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>


                                                                                <div class="row">
                                                                                    <div hidden class="col-sm-8" id="clearance">
                                                                                        <label style="font-size:14px">* If with mentioned condition, has presented medical clearance prior to vaccination day?</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1"></div>
                                                                                    <div hidden class="col-sm-3" id="clearance1">
                                                                                        <select class="form-control select2" style="width:100%" name="medical_clearance" id="medical_clearance" value="<?php echo $medical_clearance; ?>">
                                                                                            <!-- <option>Choose here</option> -->
                                                                                            <option>Please select</option>
                                                                                            <option <?php if ($clearance == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                            <option <?php if ($clearance == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                        </select>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="tab-pane fade" id="nav-pregnancy" role="tabpanel" aria-labelledby="nav-pregnancy-tab">
                                                                            <div>

                                                                                <div class="row">
                                                                                    <div class="col-md-7">
                                                                                        <label>Not Pregnant?</label>
                                                                                    </div>
                                                                                    <div class="col-md-1"></div>
                                                                                    <div class="col-md-4">
                                                                                        <select class="form-control select2" style="width:100%" name="preg_status" id="preg_status" value="<?php echo $get_pregstatus ?>">
                                                                                            <option>Select pregnancy status...</option>
                                                                                            <option <?php if ($get_pregstatus == '01_Pregnant') echo 'selected'; ?> value="02_No">No</option>
                                                                                            <option <?php if ($get_pregstatus == '02_Not_Pregnant') echo 'selected'; ?> value="01_Yes">Yes</option>

                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>

                                                                                <?php if ($get_pregstatus == '01_Pregnant') { ?>
                                                                                    <div id="preg_sem" class="row">
                                                                                    <?php } else { ?>
                                                                                        <div hidden id="preg_sem" class="row">
                                                                                        <?php } ?>

                                                                                        <div class="col-sm-7">
                                                                                            <label> If pregnant, 2nd or 3rd trimester?</label>
                                                                                        </div>
                                                                                        <div class="col-md-1"></div>
                                                                                        <div class="col-md-4">
                                                                                            <select class="form-control select2" style="width:100%" name="preg_semester" id="preg_semester" value="<?php echo $pregnant_semester ?>">
                                                                                                <option>Please select</option>
                                                                                                <option <?php if ($semester == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                                <option <?php if ($semester == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        </div>


                                                                                    </div>
                                                                            </div>


                                                                        </div>


                                                                    </div>

                                                                </div>
                                                            </div>


                                                            <!-- start of deferral -->
                                                            <div class="card card-success card-outline">
                                                                <div class="card-header">

                                                                    <h5 class="m-0">DEFERRAL</h5>
                                                                </div>

                                                                <div class="card-body">

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="">Reason:</label>
                                                                            <select class="form-control select2" id="deferral" style="width: 100%;" name="deferral" placeholder="" value="<?php echo $deferral; ?>">
                                                                                <option selected value="">Please select</option>
                                                                                <?php while ($get_deferral = $get_all_deferral_sql->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                    <?php $selected = ($deferral == $get_deferral['deferral']) ? 'selected' : ''; ?>
                                                                                    <option <?= $selected; ?> value="<?php echo $get_deferral['deferral']; ?>"><?php echo $get_deferral['deferral']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- end of deferral -->


                                                            <!-- start of vaccine information -->
                                                            <?php if ($consent == '01_Yes') { ?>
                                                                <div id="vaccine_info" class="card card-success card-outline">
                                                                <?php }else{ ?>
                                                                    <div hidden id="vaccine_info" class="card card-success card-outline">
                                                                <?php } ?>
                                                                    <div class="card-header">

                                                                        <h5 class="m-0">VACCINE INFORMATION</h5>
                                                                    </div>

                                                                    <div class="card-body">

                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <label>Vaccination Date: </label>
                                                                                <div class="input-group date" data-provide="datepicker">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="fa fa-calendar"></i>
                                                                                    </div>
                                                                                    <?php if ($vaccination_date == ''){ ?>
                                                                                        <input type="text" class="form-control pull-right" style="width: 90%;" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo date('Y-m-d'); ?>">
                                                                                    <?php }else{ ?> 
                                                                                    <input type="text" class="form-control pull-right" style="width: 90%;" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo $vaccination_date; ?>">
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-6">
                                                                                <label for="">Vaccine Manufacturer: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <select class="form-control select2" id="vaccine_manufacturer" style="width: 100%;" name="vaccine_manufacturer" placeholder="" value="">
                                                                                    <option selected value="">Select Manufacturer</option>
                                                                                    <?php while ($get_manufacturer = $get_all_manufacturer_sql->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                        <?php $selected = ($vaccine_manufacturer == $get_manufacturer['manufacturer']) ? 'selected' : ''; ?>
                                                                                        <option <?= $selected; ?> value="<?php echo $get_manufacturer['manufacturer']; ?>"><?php echo $get_manufacturer['manufacturer']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>

                                                                        </div><br>

                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <label for="">Batch Number: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="batch_number" id="batch_number" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Batch Number" value="<?php echo $batch_number; ?>">
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label for="">Lot Number: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="lot_number" id="lot_number" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Lot Number" value="<?php echo $lot_number; ?>">
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="">Vaccinator Name: &nbsp;&nbsp; <span id="required">*</span></label>

                                                                                <select class="form-control select2" id="vaccinator1" style="width: 100%;" name="vaccinator" placeholder="" value="">
                                                                                    <option value="">Select Vaccinator</option>
                                                                                    <?php while ($get_vaccinator = $get_all_vaccinator_sql->fetch(PDO::FETCH_ASSOC)) { ?>

                                                                                        <?php $selected = ($get_vaccinator_name == $get_vaccinator['f_name'] . ' ' . $get_vaccinator['m_name'] . ' ' . $get_vaccinator['l_name']) ? 'selected' : ''; ?>
                                                                                        <option <?= $selected; ?> value="<?php echo $get_vaccinator['f_name'] . ' ' . $get_vaccinator['m_name'] . ' ' . $get_vaccinator['l_name']; ?>"><?php echo $get_vaccinator['f_name'] . ' ' . $get_vaccinator['m_name'] . ' ' . $get_vaccinator['l_name']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label for="">Profession of Vaccinator: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="profession_vaccinator" id="profession_vaccinator" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Profession" value="<?php echo $profession_vaccinator; ?>">

                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <label>1st Dose</label>
                                                                                <select name="first_dose" id="first_dose" style="width:100%" class="form-control " value="<?php echo $dose_1st; ?>">
                                                                                    <option>Please select</option>
                                                                                    <option <?php if ($dose_1st == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                    <option <?php if ($dose_1st == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <label>2nd Dose</label>
                                                                                <select name="second_dose" id="second_dose" style="width:100%" class="form-control " value="<?php echo $dose_2nd; ?>">
                                                                                    <option>Please select</option>
                                                                                    <option <?php if ($dose_2nd == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                    <option <?php if ($dose_2nd == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                         

                                                            <!-- end vaccine information -->


                                                            <div class="box-footer" align="center">
                                                                <button type="submit" id="btnSubmit" name="update_assessment" class="btn btn-success">
                                                                    <!-- <i class="fa fa-check fa-fw"> </i> -->
                                                                    <h4>Submit Form</h4>
                                                                </button>

                                                            </div>
                                            </form>
                                        </div>


                            </section>
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

    <script src="../plugins/sweetalert/sweetalert.min.js"></script>

    <script src="../plugins/select2/select2.full.min.js"></script>


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
        $(function() {

            $('#vaccinator1').on('change', function() {
                var vaccinator = this.value;
                // alert(vaccinator);
                console.log(vaccinator);
                $.ajax({
                    type: "POST",
                    url: 'profile_vaccinator.php',
                    data: {
                        vaccinator: vaccinator
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
                        $('#profession_vaccinator').val(result.data1);

                    },
                });

            });

        });

        $(function() {

            // $("#category_id").select2({
            //     //  minimumInputLength: 3,
            //     // placeholder: "hello",
            //     ajax: {
            //         url: "individual_query_patient", // json datasource
            //         type: "post",
            //         dataType: 'json',
            //         delay: 250,
            //         data: function(params) {
            //             return {
            //                 searchTerm: params.term
            //             };
            //         },

            //         processResults: function(response) {
            //             return {
            //                 results: response


            //             };
            //         },
            //         cache: true,
            //         error: function(xhr, b, c) {
            //             console.log(
            //                 "xhr=" +
            //                 xhr.responseText +
            //                 " b=" +
            //                 b.responseText +
            //                 " c=" +
            //                 c.responseText
            //             );
            //         }
            //     }
            // });

        });

        // $('#gender').change(function() {
        //     var option = $('#gender').val();
        //     if (option == "Male") {
        //         $('#pregnant').select2("val", "02_Not_Pregnant")

        //     }

        //     console.log("test");
        // });



        $('#category').change(function() {
            var option = $('#category').val();
            //if Senior_Citizen is Selected
            if (option == "02_Senior_Citizen") {
                $('#indigent').prop("hidden", false);
                $('#healthworker').prop("hidden", true);


            }

            //if Health_Care_Worker is Selected
            if (option == "01_Health_Care_Worker") {
                $('#healthworker').prop("hidden", false);
                $('#indigent').prop("hidden", true);


            }

            //if 03_Indigent is Selected
            if (option == "03_Indigent") {
                $('#healthworker').prop("hidden", true);
                $('#indigent').prop("hidden", true);



            }
            //if 04_Uniformed_Personnel is Selected
            if (option == "04_Uniformed_Personnel") {
                $('#healthworker').prop("hidden", true);
                $('#indigent').prop("hidden", true);



            }

            //if 05_Essential_Worker is Selected
            if (option == "05_Essential_Worker") {
                $('#healthworker').prop("hidden", true);
                $('#indigent').prop("hidden", true);



            }

            //if 06_Other is Selected
            if (option == "06_Other") {
                $('#healthworker').prop("hidden", true);
                $('#indigent').prop("hidden", true);



            }





            console.log("test");
        });

        // $('#category').change(function() {
        //     var option = $('#healthworker').val();
        //     if (option == "01_Health_Care_Worker") {
        //         $('#healthworker').prop("hidden", false);



        //     } else {

        //         $('#healthworker').prop("hidden", true);
        //         $('#indigent').prop("hidden", true);

        //     }

        //     console.log("test");
        // });



        // $('#food_allergy').change(function() {
        //     var option = $('#food_allergy').val();
        //     if (option == "02_No") {
        //         $('#allergic').prop("hidden", false);



        //     } else {

        //         $('#allergic').prop("hidden", true);

        //     }

        //     console.log("test");
        // });

        $('#allergy_PEG').change(function() {
            var option = $('#allergy_PEG').val();
            if (option == "02_No") {
                $('#allergic').prop("hidden", false);



            } else {

                $('#allergic').prop("hidden", true);

            }

            console.log("test");
        });

        $('#food_allergy').change(function() {
            var option = $('#food_allergy').val();
            if (option == "02_No") {
                $('#allergic').prop("hidden", false);



            } else {

                $('#allergic').prop("hidden", true);

            }

            console.log("test");
        });

        $('#bleeding_history').change(function() {
            var option = $('#bleeding_history').val();
            if (option == "02_No") {
                $('#bleeding').prop("hidden", false);
                $('#bleeding1').prop("hidden", false);



            } else {

                $('#bleeding').prop("hidden", true);
                $('#bleeding1').prop("hidden", true);

            }

            console.log("test");
        });


        $('#manifest_symptoms').change(function() {
            var option = $('#manifest_symptoms').val();
            if (option == "02_No") {
                $('#symptoms').prop("hidden", false);
                $('#symptoms1').prop("hidden", false);
                $('#clearance').prop("hidden", false);
                $('#clearance1').prop("hidden", false);



            } else {

                $('#symptoms').prop("hidden", true);
                $('#symptoms1').prop("hidden", true);
                $('#clearance').prop("hidden", true);
                $('#clearance1').prop("hidden", true);

            }

            console.log("test");
        });

        $('#no_illness').change(function() {
            var option = $('#no_illness').val();
            if (option == "02_No") {
                $('#illness').prop("hidden", false);
                $('#illness1').prop("hidden", false);



            } else {

                $('#illness').prop("hidden", true);
                $('#illness1').prop("hidden", true);

            }

            console.log("test");
        });




        $('#electronic_consent').change(function() {
            var option = $('#electronic_consent').val();
            if (option == "02_No") {
                $('#reason_refusal').prop("hidden", false);



            } else {

                $('#reason_refusal').prop("hidden", true);

            }

            console.log("test");
        });


        $('#electronic_consent').change(function() {
            var option = $('#electronic_consent').val();
            if (option == "01_Yes") {
                $('#vaccine_info').prop("hidden", false);



            } else {

                $('#vaccine_info').prop("hidden", true);

            }

            console.log("test");
        });

        $('#preg_status').change(function() {
            var option = $('#preg_status').val();
            if (option == "01_Pregnant") {
                $('#preg_sem').prop("hidden", false);



            } else {

                $('#preg_sem').prop("hidden", true);

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


        $('#patient_diagnose').change(function() {
            var option = $('#patient_diagnose').val();
            if (option == "01_Yes") {
                $('#yes-diagnose').prop("hidden", false);



            } else {

                $('#yes-diagnose').prop("hidden", true);

            }

            console.log("test");
        });
    </script>


</body>

</html>