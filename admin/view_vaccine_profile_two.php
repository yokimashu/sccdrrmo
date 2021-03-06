<?php


include('../config/db_config.php');
// include('insert_vaccine.php');
session_start();

$now = new DateTime();
$time = date(' H:i');


$entity_no = ' ';

$btnSave = $btnEdit = $get_suffix = $get_contact_no = $get_street = $get_barangay = $get_city = $alert_msg =
    $get_pwdID = $get_region = $get_employerlgu =   $get_province = $get_birthdate = $get_gender = $get_fname =
    $get_mname = $get_lname = $get_entityno =   $get_datecreated = $get_timereg = $get_category = $get_categoryid =
    $get_categnumber = $get_philhealth = $get_sufiix = $get_civil_status = $get_employed = $get_profession =
    $get_directcovid =  $get_employername = $get_employeraddress = $get_employercontact = $get_pregstatus =
    $get_wallergy = $get_allergy01 = $get_allergy02 = $get_allergy03 = $get_allergy04 =
    $get_allergy05 = $get_allergy06 = $get_allergy07 = $get_allergy08 =
    $get_wcomorbidities = $get_comorbidity01 = $get_comorbidity02 = $get_comorbidity03 = $get_comorbidity04 =
    $get_comorbidity05 = $get_comorbidity06 = $get_comorbidity07 = $get_comorbidity08 =


    $get_covidhistory = $get_coviddate = $get_covidclass = $get_consent = '';
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
    $get_vaccineProfile_sql = "SELECT * FROM tbl_vaccine WHERE entity_no = :id";
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
            <section class="content-header">
                <div class="container-fluid">

                </div><!-- /.container-fluid -->
            </section>


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
                                        <h4>Update Vaccine Record</h4>
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

                                                <!-- category -->
                                                <div class="card card-success card-outline">
                                                    <div class="card-header">


                                                        <h5 class="m-0">BASIC INFORMATION</h5>
                                                    </div>
                                                    <!-- </legend> -->
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
                                                </div>
                                        </div>



                                        <!-- category -->
                                        <div class="card card-success card-outline">
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
                                            <div class="card card-success card-outline">
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


                                            <!-- end of address -->

                                            <!--  employer -->
                                            <div class="card card-success card-outline">
                                                <div class="card-header">

                                                    <h5 class="m-0">EMPLOYMENT</h5>
                                                </div>
                                                <!-- </legend> -->
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Employed : &nbsp;&nbsp; <span id="required">*</span></label>
                                                            <select class="form-control select2" style="width: 100%;" name="emp_status" id="emp_status">
                                                                <option selected value=" ">Select Employment</option>
                                                                <?php while ($get_emp_status = $get_all_employment_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <?php $selected = ($get_employed == $get_emp_status['description']) ? 'selected' : ''; ?>
                                                                    <option <?= $selected; ?> value="<?php echo $get_emp_status['description']; ?>"><?php echo $get_emp_status['status']; ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Profession :&nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <select class="form-control select2" style="width: 100%;" name="profession" id="profession">
                                                                <option selected value=" ">Select Profession</option>
                                                                <?php while ($get_prof = $get_all_profession_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <?php $selected = ($get_profession == $get_prof['description']) ? 'selected' : ''; ?>
                                                                    <option <?= $selected; ?> value="<?php echo $get_prof['description']; ?>"><?php echo $get_prof['profession']; ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>

                                                    </div><br>


                                                    <!-- end of basic information -->

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Employer Name: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" class="form-control" name="name_employeer" id="name_employeer" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Name of employer" value="<?php echo $get_employername; ?>">
                                                            <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if Not Applicable</i></span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Employer Address: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" class="form-control" name="emp_address" id="emp_address" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Street / Lot # / Block # " value="<?php echo $get_employeraddress; ?>">
                                                            <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if Not Applicable</i></span>
                                                        </div>


                                                    </div> <br>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>LGU: &nbsp;&nbsp; <span id="required">*</span> </label>

                                                            <input readonly type="text" class="form-control" name="emp_lgu" id="emp_lgu" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="LGU" value="<?php echo $get_employerlgu ?>">

                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label>Contact Number: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <input type="text" class="form-control" name="emp_contact" id="emp_contact" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Contact Number" value="<?php echo $get_employercontact; ?>">
                                                            <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if Not Applicable</i></span>
                                                        </div>
                                                    </div><br>

                                                </div>
                                            </div>


                                            <!-- end of employer fieldset -->

                                            <!-- medical conditions -->
                                            <div class="card card-success card-outline">
                                                <div class="card-header">

                                                    <h5 class="m-0">MEDICAL CONDITION</h5>
                                                </div>
                                                <!-- </legend> -->
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

                                                        <div class="col-md-4">
                                                            <label>With Allergy? </label>
                                                            <select class="form-control select2 " name="with_allergy" id="with_allergy" style="width:100%" value="<?php echo $get_wallergy; ?>">
                                                                <option>Do you have allergy?</option>
                                                                <option <?php if ($get_wallergy == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_wallergy == '02_No') echo 'selected'; ?> value="02_No">None</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>With Comorbidities?</label>
                                                            <select class="form-control select2" style="width:100%" name="with_commorbidities" id="with_commorbidities" value="<?php echo $get_wcomorbidities; ?>">
                                                                <option>Do you have comorbidities?</option>
                                                                <option <?php if ($get_wcomorbidities == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_wcomorbidities == '02_No') echo 'selected'; ?> value="02_No">None</option>
                                                            </select>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Covid History? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <select class="form-control select2" style="width:100%" name="patient_diagnose" id="patient_diagnose" value="<?php echo $get_covidhistory; ?>">
                                                                <option>Please select</option>
                                                                <option <?php if ($get_covidhistory == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_covidhistory == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Direct interaction with COVID Patient &nbsp;&nbsp; <span id="required">*</span> </label>
                                                            <select class="form-control select2" style="width:100%" name="interact_patient" id="interact_patient" value="<?php echo $get_directcovid; ?>">
                                                                <option>Choose here</option>
                                                                <option <?php if ($get_directcovid == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_directcovid == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- end of medical conditions -->

                                            <!-- kung yes ang covid history -->
                                            <?php if ($get_covidhistory == '01_Yes') { ?>
                                                <div class="card card-success card-outline" id="yes-diagnose">
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
                                                                <input type="date" style="width:100%" id="date_positive" name="date_positive" class="form-control pull-right " placeholder="dd/mm/yyyy" value="<?php echo $get_coviddate ?>" />
                                                            </div>
                                                            <div class="col-sm-4"></div>

                                                            <div class="col-sm-3">
                                                                <select name="name_infection" id="name_infection" style="width:100%" class="form-control select2">
                                                                    <option selected>Classification of Infection</option>
                                                                    <?php while ($get_infection = $get_all_infection_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                        <?php $selected = ($get_covidclass == $get_infection['description']) ? 'selected' : ''; ?>
                                                                        <option <?= $selected; ?> value="<?php echo $get_infection['description']; ?>"><?php echo $get_infection['classification']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div><br>
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <!-- </legend> -->

                                        </div>

                                        <!-- end of yes form sa covid history -->

                                        <?php if ($get_wallergy == '01_Yes') { ?>
                                            <div class="card card-success card-outline" id="yes-allergy">
                                                <div class="card-header">

                                                    <h5 class="m-0">ALLERGIES</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Drug</label>
                                                            <select name="allergy_drug" id="allergy_drug" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy01 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy01 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Food</label>
                                                            <select name="allergy_food" id="allergy_food" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy02 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy02 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Insect</label>
                                                            <select name="allergy_insect" id="allergy_insect" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy03 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy03 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Latex</label>
                                                            <select name="allergy_latex" id="allergy_latex" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy04 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy04 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Mold</label>
                                                            <select name="allergy_mold" id="allergy_mold" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy05 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy05 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Pet</label>
                                                            <select name="allergy_pet" id="allergy_pet" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy06 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy06 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Pollen</label>
                                                            <select name="allergy_pollen" id="allergy_pollen" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy07 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy07 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Vaccine and related products</label>
                                                            <select name="allergy_vaccine" id="allergy_vaccine" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_allergy08 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_allergy08 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            </select>
                                                        </div>

                                                    </div><br>

                                                </div>
                                            </div>
                                        <?php } ?>


                                        <!-- </legend> -->




                                        <!-- end of list allergy -->



                                        <?php if ($get_wcomorbidities == '01_Yes') { ?>
                                            <!-- if yes kung with comorbidities -->
                                            <div class="card card-success card-outline" id="yes-comordities">
                                                <div class="card-header">

                                                    <h5 class="m-0">COMORBIDITIES</h5>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Hypertension</label>
                                                            <select name="como_hypertension" id="como_hypertension" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity01 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity01 == '02_No') echo 'selected'; ?> value="02_No">No </option>

                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Heart disease</label>
                                                            <select name="como_heart" id="como_heart" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity02 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity02 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Kidney disease</label>
                                                            <select name="como_kidney" id="como_kidney" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity03 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity03 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Diabetes mellitus</label>
                                                            <select name="como_diabetes" id="como_diabetes" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity04 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity04 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>Bronchial Asthma</label>
                                                            <select name="como_asthma" id="como_asthma" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity05 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity05 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Immunodefiency state</label>
                                                            <select name="como_immunodeficiency" id="como_immunodeficiency" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity06 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity06 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Cancer</label>
                                                            <select name="como_cancer" id="como_cancer" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity07 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity07 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>Other</label>
                                                            <select name="como_other" id="como_other" style="width:100%" class="form-control ">
                                                                <option value="02_No"> Choose here</option>
                                                                <option <?php if ($get_comorbidity08 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                                <option <?php if ($get_comorbidity08 == '02_No') echo 'selected'; ?> value="02_No">No </option>
                                                            </select>
                                                        </div>
                                                    </div><br>
                                                </div>
                                            </div>
                                        <?php } ?>



                                        <!-- end of form choices comorbidities -->


                                        <div class="card card-success card-outline">
                                            <div class="card-header">

                                                <h5 class="m-0">CONSENT</h5>
                                            </div>
                                            <!-- </legend> -->
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Provided Electronic Informed Consent? &nbsp;&nbsp; <span id="required">*</span></label>
                                                        <select class="form-control select2" style="width:100%" name="electronic_consent" id="consentation" value="<?php echo $get_consent; ?>">
                                                            <option>Please select</option>
                                                            <option <?php if ($get_consent == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                            <option <?php if ($get_consent == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            <option <?php if ($get_consent == '03_Unknown') echo 'selected'; ?> value="03_Unknown">Unknown</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label>Willing to be vaccinated with SINOVAC? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                        <select class="form-control select2" name="sinovac" id="sinovac">
                                                            <option>Please select</option>
                                                            <option <?php if ($get_sinovac == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                            <option <?php if ($get_sinovac == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                            <option <?php if ($get_sinovac == '03_Unknown') echo 'selected'; ?> value="03_Unknown">Unknown</option>
                                                        </select>
                                                    </div>
                                                </div><br>

                                                <div class="col-sm-6">
                                                    <label>Willing to be vaccinated with ASTRAZENECA? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <select class="form-control select2" name="astrazeneca" id="astrazeneca">
                                                        <option>Please select</option>
                                                        <option <?php if ($get_astrazeneca == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                                        <option <?php if ($get_astrazeneca == '02_No') echo 'selected'; ?> value="02_No">No</option>
                                                        <option <?php if ($get_astrazeneca == '03_Unknown') echo 'selected'; ?> value="03_Unknown">Unknown</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                        </div>



                                        <div class="box-footer" align="center">


                                            <button type="submit" id="btnSubmit" name="update_vaccine" class="btn btn-success">
                                                <!-- <i class="fa fa-check fa-fw"> </i> -->
                                                <h4>Update Form</h4>
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
        // $(function() {

        //     $("#entity1").select2({
        //         //  minimumInputLength: 3,
        //         // placeholder: "hello",
        //         ajax: {
        //             url: "individual_query_patient", // json datasource
        //             type: "post",
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return {
        //                     searchTerm: params.term
        //                 };
        //             },

        //             processResults: function(response) {
        //                 return {
        //                     results: response


        //                 };
        //             },
        //             cache: true,
        //             error: function(xhr, b, c) {
        //                 console.log(
        //                     "xhr=" +
        //                     xhr.responseText +
        //                     " b=" +
        //                     b.responseText +
        //                     " c=" +
        //                     c.responseText
        //                 );
        //             }
        //         }
        //     });

        //     $('#entity1').on('change', function() {
        //         var entity_no = this.value;
        //         console.log(entity_no);
        //         $.ajax({
        //             type: "POST",
        //             url: 'profile_vaccine.php',
        //             data: {
        //                 entity_no: entity_no
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
        //                 var result = jQuery.parseJSON(response);
        //                 console.log('response from server', result);
        //                 $('#entity_number').val(result.data);
        //                 $('#fullname').val(result.data1);
        //                 $('#firstname').val(result.data2);
        //                 $('#middlename').val(result.data3);
        //                 $('#lastname').val(result.data4);
        //                 $('#birthdate').val(result.data5);
        //                 $('#street').val(result.data7);
        //                 $('#barangay').val(result.data8);
        //                 $('#age').val(result.data9);
        //                 $('#gender').val(result.data10);
        //                 $('#contact_no').val(result.data12);
        //             },
        //         });

        //     });

        // });

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
        //         $('#pregnant').select2("val","02_Not_Pregnant")

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