<?php


include('../config/db_config.php');
// include('insert_vaccine.php');
session_start();


// date_default_timezone_set('Asia/Manila');
// 
// date_default_timezone_set("America/New_York");
// echo "The time is " . date("h:i:sa");
$now = new DateTime();
// $time = date('H:i');

// $time = date("h:i:sa");

$entity_no = ' ';

$btnSave = $btnEdit = $get_entity_no = $get_age = $get_status = $get_email = $get_photo =
    $get_firstname = $get_middlename = $get_lastname = $get_suffix = $pregstatus = $wallergy =
    $allergy = $wcomorbidities = $comorbidities = $covid_history = $covid_date = $classification = $consent =
    $refusal = $age_16 = $allergy_PEG = $allergic_reaction = $no_food_allergy = $monitor_patient = $bleeding_history = $yes_bleeding_history=
    $manifest_symptoms = $specify_symptoms = $no_exposure = $no_treated = $no_received_vaccine = $no_received_antibodies = $pregnant_semester=
    $no_illness = $specify_illness = $medical_clearance = $deferral = $vaccination_date = $vaccine_manufacturer = $batch_number = $lot_number=
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
    $get_vaccineProfile_sql = "SELECT * FROM tbl_assessment a inner join tbl_vaccine v on v.entity_no = a.entity_no WHERE a.entity_no = :id";
    $vaccineprofile_data = $con->prepare($get_vaccineProfile_sql);
    $vaccineprofile_data->execute([':id' => $entity_no]);
    while ($result = $vaccineprofile_data->fetch(PDO::FETCH_ASSOC)) {
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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">

                </div><!-- /.container-fluid -->
            </section>



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

                                    <h2 class="profile-username text-center"><?php echo $get_firstname . ' ' . $get_middlename . '.' . ' ' . $get_lastname . ' ' . $get_suffix; ?></h2>

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


                                    <strong><i class="fa fa-pencil mr-1"></i> <a href="update_assessment.php?entity_no=<?php echo $entity_no; ?> "> View VAS </a> </strong>


                                    <p class="text-muted">

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
                                        <h4>Vaccine Assessment and Screening (VAS)</h4>
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


                                                    <div class="col-md-2">
                                                        <label> Time Registered:</label>
                                                        <input readonly type="text" class="form-control" style="text-align:center;" name="time" id="time" placeholder="Time Registered" value="<?php echo $get_timereg; ?>" required>
                                                    </div>

                                                </div>


                                                <!-- <div class="card card-success card-outline">
                                                    <div class="card-header">


                                                        <h5 class="m-0">BASIC INFORMATION</h5>
                                                    </div>
                                                    
                                                    <div class="card-body">

                                                        <div class="row">

                                                            <div hidden class="col-sm-5">
                                                                <label>Entity Number : &nbsp;&nbsp; <span id="required">*</span></label>
                                                                <input type="text" readonly class="form-control" id="entity_number" name="entity_number" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity Number" value="<?php echo $get_entity_no; ?>">
                                                            </div>

                                                        </div><br>


                                                        <div class="row">

                                                            <div class="col-sm-3">
                                                                <label>First name: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                                <input type="text" class="form-control" id="firstname" name="firstname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="First name" value="<?php echo $get_firstname; ?>">
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label>Middle name: </label>
                                                                <input type="text" class="form-control" id="middlename" name="middlename" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Middle name" value="<?php echo $get_middlename; ?>">

                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Last name : &nbsp;&nbsp; <span id="required">*</span></label>
                                                                <input type="text" class="form-control" id="lastname" name="lastname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Last name" value="<?php echo $get_lastname; ?>">
                                                            </div>
                                                            <div class="col-sm-3">

                                                                <label>Extension name: </label>
                                                                <input type="text" class="form-control" id="suffix" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" name="suffix" placeholder="Extension name" value="<?php echo $get_suffix; ?>">

                                                            </div>
                                                        </div><br>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Gender: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                                <select class="form-control select2" style="width:100%" id="gender" name="gender" placeholder="Gender" value="">
                                                                    <option <?php if ($get_gender == ' ') echo 'selected'; ?>>Select Gender</option>
                                                                    <option <?php if ($get_gender == '01_Female' || $get_gender == "Female") echo 'selected'; ?> value="01_Female">Female </option>
                                                                    <option <?php if ($get_gender == '02_Male' || $get_gender == "Male") echo 'selected'; ?> value="02_Male">Male </option>
                                                                    <option <?php if ($get_gender == '03_Not_to_disclose') echo 'selected'; ?> value="03_Not_to_disclose">No to disclose</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label>Birthdate: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                <input type="date" class="form-control" id="birthdate" name="birthdate" value=<?php echo $get_birthdate; ?>>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label>Civil Status: </label>
                                                                <select class="form-control select2" style="width: 100%;" name="civil_status" id="civil_status">
                                                                    <option selected value=" ">Select Civil Status</option>
                                                                    <?php while ($get_civil = $get_all_civilstatus_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                        <?php $selected = ($get_civil_status == $get_civil['description']) ? 'selected' : ''; ?>
                                                                        <option <?= $selected; ?> value="<?php echo $get_civil['description']; ?>"><?php echo $get_civil['name_civilstatus']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label>Contact No: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number" value=<?php echo $get_mobile_no; ?>>
                                                            </div>
                                                        </div><br>

                                                    </div>
                                                </div> -->
                                        </div>



                                        <!-- category -->
                                        <div hidden class="card card-success card-outline">
                                            <div class="card-header">

                                                <h5 class="m-0">CATEGORY</h5>
                                            </div>
                                            <!-- </legend> -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="">Category: &nbsp;&nbsp; <span id="required">*</span></label>
                                                        <select class="form-control select2" style="width: 100%;" name="category" id="category">
                                                            <option value=" " selected>Select Category</option>
                                                            <?php while ($get_ctgry = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                <?php $selected = ($get_category == $get_ctgry['description']) ? 'selected' : ''; ?>
                                                                <option <?= $selected; ?> value="<?php echo $get_ctgry['description']; ?>"><?php echo $get_ctgry['category']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2" id="indigent" hidden>
                                                        <label> Indigent or not?</label>
                                                        <select class="form-control select2" style="width:100%" name="indigent" id="indigent">
                                                            <option value=" " selected> Select status </option>
                                                            <option value="01_Indigent">Indigent</option>
                                                            <option value="02_Not_Indigent">Not Indigent</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="">Type of ID:&nbsp;&nbsp; <span id="required">*</span></label>
                                                        <select class="form-control select2" style="width: 100%;" id="category_id" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name="category_id" value="">
                                                            <option value=" " selected>Select Category ID</option>
                                                            <?php while ($get_id = $get_all_category_id_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                <?php $selected = ($get_categoryid == $get_id['description']) ? 'selected' : ''; ?>
                                                                <option <?= $selected; ?> value="<?php echo $get_id['description']; ?>"><?php echo $get_id['categ_id_type']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <?php if ($get_healthworker != ' ') { ?>
                                                        <div class="col-sm-4" id="healthworker">
                                                        <?php } else { ?>
                                                            <div class="col-sm-4" id="healthworker" hidden>
                                                            <?php } ?>

                                                            <label for="">Type of Health Worker: &nbsp;&nbsp; <span id="required">*</span></label>
                                                            <select class="form-control select2" style="width: 100%;" id="health_worker" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name="health_worker" value="">
                                                                <option value=" " selected>Select Health Worker</option>
                                                                <?php while ($get_health = $get_all_healthworkers_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <?php $selected = ($get_healthworker == $get_health['idno']) ? 'selected' : ''; ?>
                                                                    <option <?= $selected; ?> value="<?php echo $get_health['idno']; ?>"><?php echo $get_health['description']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>


                                                        </div><br>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label>ID Number: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                                <input type="text" class="form-control" id="idno" name="idno" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="ID Number" value="<?php echo $get_categoryno ?>">
                                                                <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if Not Applicable</i></span>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Philhealth ID : &nbsp;&nbsp; <span id="required">*</span></label>
                                                                <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Philhealth ID" value="<?php echo $get_philhealth; ?>">
                                                                <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if no PhilHealth ID #</i></span>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <label>PWD ID : </label>
                                                                <input type="text" class="form-control" id="pwd_id" name="pwd_id" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="PWD ID" value="<?php echo $get_pwdID ?>">
                                                                <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if Not Applicable</i></span>
                                                            </div>

                                                        </div><br>
                                                        <!-- </fieldset><br> -->

                                                </div>
                                            </div>



                                            <!-- basic information -->

                                            <!-- address -->
                                            <div hidden class="card card-success card-outline">
                                                <div class="card-header">

                                                    <h5 class="m-0">ADDRESS</h5>
                                                </div>
                                                <!-- </legend> -->
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Region :&nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" readonly class="form-control" placeholder="Contact Number" value="<?php echo $region ?>">


                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Province :&nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" readonly class="form-control" name="province" placeholder="Province" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" value="<?php echo $province ?>">
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label>City / Municipality :&nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" class="form-control" name="city" placeholder="City" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" value="<?php echo $city ?>">
                                                        </div>

                                                    </div><br>
                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <label>Barangay: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" class="form-control" id="barangay" name="barangay" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Barangay" value="<?php echo $get_barangay; ?>">
                                                        </div>

                                                        <div class="col-sm-8">
                                                            <label for="">Complete Address: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" class=" form-control" name="street" id="street" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Street / Block # / Lot # " value="<?php echo $get_street; ?>">
                                                        </div>
                                                    </div><br>


                                                </div>
                                            </div>

                                            <!-- </fieldset><br> -->
                                            <!-- end of address -->

                                            <!--pregnancy status-->
                                            <div class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h5 class="m-0">PREGNANCY STATUS</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">


                                                        <div class="col-md-4">
                                                            <label> If female, pregnancy status?</label>
                                                            <select class="form-control select2" style="width:100%" name="preg_status" id="preg_status" value="<?php echo $get_pregstatus ?>">
                                                                <option>Select pregnancy status...</option>
                                                                <option <?php if ($get_pregstatus == '01_Pregnant') echo 'selected'; ?> value="01_Pregnant">Pregnant </option>
                                                                <option <?php if ($get_pregstatus == '02_Not_Pregnant') echo 'selected'; ?> value="02_Not_Pregnant">Not Pregnant </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-5">
                                                            <label> If pregnant, 2nd or 3rd trimester?</label>
                                                            <select class="form-control select2" style="width:100%" name="preg_semester" id="preg_semester" value= "<?php echo $pregnant_semester?>">
                                                                <option selected> Please select</option>
                                                                <option value="01_Yes">Yes</option>
                                                                <option value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end pregnancy status -->

                                            <!-- medical conditions -->
                                            <div class="card card-success card-outline">
                                                <div class="card-header">
                                                    <!-- <fieldset class="form-control field_set">
                                    <legend id="fieldset-category"> -->

                                                    <h5 class="m-0">MEDICAL CONDITION</h5>
                                                </div>
                                                <!-- </legend> -->
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>With Comorbidities?</label>
                                                            <select class="form-control select2" style="width:100%" name="with_commorbidities" id="with_commorbidities" value = "<?php echo $get_wcomorbidities; ?>">
                                                                <!-- <option>Do you have comorbidities?</option> -->
                                                                <option <?php if ($get_wcomorbidities == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_wcomorbidities == '02_No') echo 'selected'; ?> value="02_No">None </option>
                                                            </select>
                                                        </div>
                                                    </div><br>

                                                </div>
                                            </div>


                                            <!-- </fieldset> -->
                                            <!-- end of medical conditions -->

                                            <!-- if yes kung with comorbidities -->
                                            <div class="card card-success card-outline" hidden id="yes-comordities">
                                                <div class="card-header">
                                                    <!-- <fieldset class="form-control field_set">
                                    <legend id="fieldset-category"> -->

                                                    <h5 class="m-0">COMORBIDITIES</h5>
                                                </div>
                                                <!-- </legend> -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Hypertension</label>
                                                            <select name="como_hypertension" id="como_hypertension" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Heart disease</label>
                                                            <select name="como_heart" id="como_heart" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Kidney disease</label>
                                                            <select name="como_kidney" id="como_kidney" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Diabetes mellitus</label>
                                                            <select name="como_diabetes" id="como_diabetes" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>

                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Bronchial Asthma</label>
                                                            <select name="como_asthma" id="como_asthma" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Immunodefiency state</label>
                                                            <select name="como_immunodeficiency" id="como_immunodeficiency" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Cancer</label>
                                                            <select name="como_cancer" id="como_cancer" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Other</label>
                                                            <select name="como_other" id="como_other" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>

                                                    </div><br>

                                                </div>
                                            </div>


                                            <!-- end of form choices comorbidities -->


                                            <div class="card">

                                                <div class="card-header p-2 card-success card-outline">
                                                    <div class="nav nav-pills" id="nav-tab" role="tablist">
                                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-allergy" role="tab" aria-controls="nav-home" aria-selected="true">ALLERGY INFORMATION</a>
                                                        <a class="nav-item nav-link" id="nav-covid-tab" data-toggle="tab" href="#nav-covid" role="tab" aria-controls="nav-covid" aria-selected="false">COVID INFORMATION</a>
                                                        <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab" aria-controls="nav-other" aria-selected="false">OTHER INFORMATION</a>
                                                        <a class="nav-item nav-link" id="nav-vaccine-tab" data-toggle="tab" href="#nav-vaccine" role="tab" aria-controls="nav-vaccine" aria-selected="false">VACCINE INFORMATION</a>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="box-body">
                                                        <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                                                            <div class="tab-content" id="nav-tabContent">

                                                                <div class="tab-pane fade show active" id="nav-allergy" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                    <div>

                                                                        <div class="row">

                                                                            <div class="col-sm-6">
                                                                                <label>With Allergy? </label>
                                                                                <select class="form-control select2  " name="with_allergy" id="with_allergy" style="width:100%" value = "<?php echo $get_wallergy; ?>">
                                                                                    <!-- <option>Do you have allergy?</option> -->
                                                                                    <option <?php if ($get_wallergy == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                    <option <?php if ($get_wallergy == '02_No') echo 'selected'; ?> value="02_No">None </option>
                                                                                </select>
                                                                            </div>


                                                                            <div class="col-sm-6">
                                                                                <label>Has no allergies to PEG or polysorbate?</label>
                                                                                <select class="form-control select2" style="width:100%" name="allergy_PEG" id="allergy_PEG" value = "<?php echo $allergy_PEG; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">

                                                                            <div class="col-sm-6">
                                                                                <label>Has no allergy to food, egg, medicines, and no asthma?</label>
                                                                                <select class="form-control select2" style="width:100%" name="food_allergy" id="food_allergy" value = "<?php echo $no_food_allergy; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-sm-5">
                                                                                <label>* If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?</label>
                                                                                <select class="form-control select2" style="width:100%" name="monitor_patient" id="monitor_patient" value = "<?php echo $monitor_patient; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label>Has no severe allergic reaction after the 1st dose of the vaccine?</label>
                                                                                <select class="form-control select2" style="width:100%" name="allergic_reaction" id="allergic_reaction" value = "<?php echo $allergic_reaction; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div class="tab-pane fade" id="nav-covid" role="tabpanel" aria-labelledby="nav-covid-tab">
                                                                    <div>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px"> COVID History? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                                                <select class="form-control select2" style="width:100%" name="patient_diagnose" id="patient_diagnose" value = "<?php echo $get_covidhistory; ?>">
                                                                                    <!-- <option>Please select</option> -->
                                                                                    <option <?php if ($get_covidhistory == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                    <option <?php if ($get_covidhistory == '02_No') echo 'selected'; ?> value="02_No">None </option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Directly in interaction with COVID patient &nbsp;&nbsp; <span id="required">*</span> </label>
                                                                                <select class="form-control select2" style="width:100%" name="interact_patient" id="interact_patient" value="<?php echo $get_directcovid; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option <?php if ($get_directcovid == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                                    <option <?php if ($get_directcovid == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?</label>
                                                                                <select class="form-control select2" style="width:100%" name="covid_exposure" id="covid_exposure" value="<?php echo $no_exposure; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>


                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Has not been previously treated for COVID-19 in the past 90 days?</label>
                                                                                <select class="form-control select2" style="width:100%" name="covid_treated" id="covid_treated" value="<?php echo $no_treated; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>


                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?</label>
                                                                                <select class="form-control select2" style="width:100%" name="covid_antibody" id="covid_antibody" value="<?php echo $no_received_antibodies; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>



                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">

                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Age more than 16 years old?</label>
                                                                                <select class="form-control select2" style="width:100%" name="age_16" id="age_16" value = "<?php echo $age_16; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Has no history of bleeding disorders or currently taking anti-coagulants?</label>
                                                                                <select class="form-control select2" style="width:100%" name="bleeding_history" id="bleeding_history" value = "<?php echo $bleeding_history; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">* If with bleeding history, is a gauge 23 - 25 syringe available for injection?</label>
                                                                                <select class="form-control select2" style="width:100%" name="yes_bleeding" id="yes_bleeding" value = "<?php echo $yes_bleeding_history; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Has not received any vaccine in the past 2 weeks?</label>
                                                                                <select class="form-control select2" style="width:100%" name="no_received_vaccine" id="no_received_vaccine" value="<?php echo $no_received_vaccine; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat, Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing</label>
                                                                                <select class="form-control select2" style="width:100%" name="manifest_symptoms" id="manifest_symptoms" value = "<?php echo $manifest_symptoms; ?>">
                                                                                    <!-- <option>Do you have comorbidities?</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px" for="">* If manifesting any of the mentioned symptom/s, specify all that apply</label>
                                                                                <select class="form-control select2" id="symptoms" style="width: 100%;" multiple="" name="list_symptoms[]" placeholder="Select Symptoms" required >
                                                                                    <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                        <option value="<?php echo $get_symptoms['idno']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis</label>
                                                                                <select class="form-control select2" style="width:100%" name="no_illness" id="no_illness" value="<?php echo $no_illness; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">None</option>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px" for="">* If manifesting any of the mentioned symptom/s, specify.</label>
                                                                                <select class="form-control select2" id="complications" style="width: 100%;" multiple="" name="list_illness[]" placeholder="Select Illness" required value = "<?php echo $specify_illness; ?>">
                                                                                    <?php while ($get_complications = $get_all_complications_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                        <option value="<?php echo $get_complications['idno']; ?>"><?php echo $get_complications['complications']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div><br>


                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label style="font-size:14px">* If with mentioned condition, has presented medical clearance prior to vaccination day?</label>
                                                                                <select class="form-control select2" style="width:100%" name="medical_clearance" id="medical_clearance" value="<?php echo $medical_clearance; ?>">
                                                                                    <!-- <option>Choose here</option> -->
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="nav-vaccine" role="tabpanel" aria-labelledby="nav-vaccine-tab">
                                                                    <div>

                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <label>Vaccination Date: </label>
                                                                                <div class="input-group date" data-provide="datepicker">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="fa fa-calendar"></i>
                                                                                    </div>
                                                                                    <input type="text" class="form-control pull-right" style="width: 90%;" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo $vaccination_date; ?>">
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-6">
                                                                                <label for="">Vaccine Manufacturer: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="vaccine_manufacturer" id="vaccine_manufacturer" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Manufacturer" value="<?php echo $vaccine_manufacturer; ?>">
                                                                            </div>

                                                                        </div><br>

                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <label for="">Batch Number: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="batch_number" id="batch_number" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Batch Number" value="<?php echo $batch_number; ?>">
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label for="">Lot Number: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="lot_number" id="lot_number" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Lot Number"value="<?php echo $lot_number; ?>">
                                                                            </div>
                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="">Vaccinator Name: &nbsp;&nbsp; <span id="required">*</span></label>
                                                                                <input type="text" class="form-control" name="vaccinator" id="vaccinator" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Vaccinator" value="<?php echo $vaccinator_name; ?>">
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
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <label>2nd Dose</label>
                                                                                <select name="second_dose" id="second_dose" style="width:100%" class="form-control " value="<?php echo $dose_2nd; ?>">
                                                                                    <option value="01_Yes">Yes</option>
                                                                                    <option selected value="02_No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>



                                            <!-- allergy information-->
                                            <div hidden class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h5 class="m-0">ALLERGY INFORMATION</h5>
                                                </div>
                                                <div class="card-body">






                                                </div>
                                            </div>

                                            <!-- end of allergy -->

                                            <!-- if yes kung naay allergy -->
                                            <div class="card card-success card-outline" hidden id="yes-allergy">
                                                <div class="card-header">
                                                    <h5 class="m-0">ALLERGIES</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Drug</label>
                                                            <select name="allergy_drug" id="allergy_drug" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Food</label>
                                                            <select name="allergy_food" id="allergy_food" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Insect</label>
                                                            <select name="allergy_insect" id="allergy_insect" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Latex</label>
                                                            <select name="allergy_latex" id="allergy_latex" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Mold</label>
                                                            <select name="allergy_mold" id="allergy_mold" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Pet</label>
                                                            <select name="allergy_pet" id="allergy_pet" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Pollen</label>
                                                            <select name="allergy_pollen" id="allergy_pollen" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Vaccine and related products</label>
                                                            <select name="allergy_vaccine" id="allergy_vaccine" style="width:100%" class="form-control ">
                                                                <option value="01_Yes">Yes</option>
                                                                <option selected value="02_No">No</option>
                                                            </select>
                                                        </div>

                                                    </div><br>
                                                </div>
                                            </div>

                                            <!-- end sa choices sa form sa allergies -->



                                            <!-- covid information -->
                                            <div hidden class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h5 class="m-0">COVID INFORMATION </5>
                                                </div>
                                                <div class="card-body">

                                                </div>
                                            </div>
                                            <!-- end covid information -->

                                            <!-- kung yes ang covid history -->
                                            <div class="card card-success card-outline" hidden id="yes-diagnose">
                                                <div class="card-header">
                                                    <h5 class="m-0">COVID HISTORY</h5>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Date of first positive result /specimen collection? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Classification of infection?</label>

                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <input type="date" style="width:100%" id="date_positive" name="date_positive" class="form-control pull-right " placeholder="dd/mm/yyyy" />
                                                        </div>
                                                        <div class="col-sm-4"></div>

                                                        <div class="col-sm-3">
                                                            <select name="name_infection" id="name_infection" style="width:100%" class="form-control select2">
                                                                <option selected>Classification of Infection</option>
                                                                <?php while ($get_infection = $get_all_infection_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $get_infection['description'] ?>"><?php echo $get_infection['classification']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div><br>
                                                </div>
                                            </div>
                                            <!-- end of yes form sa covid history -->


                                            <!-- other information -->

                                            <div hidden class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h5 class="m-0">
                                                        OTHER INFORMATION
                                                    </h5>
                                                </div>
                                                <div class="card-body">

                                                </div>
                                            </div>

                                            <!-- end other information -->


                                            <div class="card card-success card-outline">
                                                <div class="card-header">

                                                    <h5 class="m-0">CONSENT</h5>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Provided Electronic Informed Consent &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <select class="form-control select2" name="electronic_consent" id="electronic_consent" value="<?php echo $consent; ?>">
                                                                <!-- <option value="01_Yes">Yes</option> -->
                                                                <option <?php if ($consent == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($consent == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="">Reason for refusal</label>
                                                            <select class="form-control select2" id="refusal" style="width: 100%;" name="refusal" placeholder="Select Complications" required value="<?php echo $refusal; ?>">
                                                                <?php while ($get_reason = $get_all_reason_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $get_reason['idno']; ?>"><?php echo $get_reason['reason']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Willing to be vaccinated with ASTRAZENECA? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <select class="form-control select2" name="astrazeneca" id="astrazeneca" value="<?php echo $get_astrazeneca; ?>">
                                                            <option <?php if ($get_astrazeneca == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                            <option <?php if ($get_astrazeneca == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            <option <?php if ($get_astrazeneca == '03_Unknown') echo 'selected'; ?> value="03_Unknown">Unknown</option>

                                                            </select>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label>Willing to be vaccinated with SINOVAC? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <select class="form-control select2" name="sinovac" id="sinovac" value="<?php echo $get_sinovac; ?>">
                                                            <option <?php if ($get_sinovac == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                            <option <?php if ($get_sinovac == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            <option <?php if ($get_sinovac == '03_Unknown') echo 'selected'; ?> value="03_Unknown">Unknown</option>
                                                            </select>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                    <div class="col-md-6">
                                                            <label for="">Deferral</label>
                                                            <select class="form-control select2" id="deferral" style="width: 100%;" name="deferral" placeholder="Select Complications" required value="<?php echo $deferral; ?>">
                                                                <?php while ($get_deferral = $get_all_deferral_sql->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $get_deferral['idno']; ?>"><?php echo $get_deferral['deferral']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div><br>
                                            </div>

                                            <div class="box-footer" align="center">
                                                <button type="submit" id="btnSubmit" name="insert_assessment" class="btn btn-success">
                                                    <!-- <i class="fa fa-check fa-fw"> </i> -->
                                                    <h4>Submit Form</h4>
                                                </button>

                                                <!-- <a href="list_vaccine_profile">
                                        <button type="button" name="cancel" class="btn btn-danger">
                                            <i class="fa fa-close fa-fw"> </i> </button>
                                    </a> -->

                                                <!-- <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
                                    <button type="button" name="print" class="btn btn-primary">
                                        <i class="nav-icon fa fa-print"> </i> </button>
                                    </a> -->

                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        </form>
                        <!-- </div>
                    </div>

                </div> -->
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




    <script language="JavaScript">
        $('.select2').select2();


        $("#name_comorbidities").select2({
            theme: "classic"
        });
    </script>


    <script>
        $(function() {

            $("#entity1").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "vaccine_query_patient", // json datasource
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

            $('#entity1').on('change', function() {
                var entity_no = this.value;
                console.log(entity_no);
                $.ajax({
                    type: "POST",
                    url: 'profile_vaccine.php',
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
                        $('#entity_number').val(result.data);
                        $('#fullname').val(result.data1);
                        $('#firstname').val(result.data2);
                        $('#middlename').val(result.data3);
                        $('#lastname').val(result.data4);
                        $('#birthdate').val(result.data5);
                        $('#street').val(result.data7);
                        $('#barangay').val(result.data8);
                        $('#age').val(result.data9);

                        var gender = result.data10;

                        if (gender == 'Female') {
                            $("#gender").select2("val", "01_Female");
                            $('#preg_status').select2("val", "Select pregnancy status...")
                        } else if (gender == 'Male') {
                            $("#gender").select2("val", "02_Male");
                            $('#preg_status').select2("val", "02_Not_Pregnant")
                        }

                        $('#contact_no').val(result.data12);
                        $('#tphoto').attr("src", "../flutter/images/" + result.data13);
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