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

$btnSave = $btnEdit = $pregstatus = $wallergy = $allergy = $wcomorbidities = $comorbidities = $covid_history = $covid_date = $classification = $consent = '';
$btnNew = 'hidden';
$btn_enabled = 'enabled';
$img = '';


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

$get_all_infection_sql = "SELECT * FROM tbl_infection";
$get_all_infection_data = $con->prepare($get_all_infection_sql);
$get_all_infection_data->execute();

$get_all_healthworkers_sql = "SELECT * FROM tbl_health_workers";
$get_all_healthworkers_data = $con->prepare($get_all_healthworkers_sql);
$get_all_healthworkers_data->execute();

$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
$nationality = ' FILIPINO';
$region = 'WESTERN VISAYAS';


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
            <!-- 
            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div> -->

            <section class="content">
                <div class="card">

                    <div class="card-header bg-success text-white">
                        <h4>New Vaccine Record</h4>
                    </div>

                    <div class="card-body">
                        <div class="box-body">
                            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="insert_vaccine.php">

                                <div class="row" hidden>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2">
                                        <label>Date Registered: </label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" readonly class="form-control pull-right" style="width: 90%;" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                        </div>
                                    </div>



                                </div>


      <!-- basic information -->
      <fieldset class="form-control field_set">
                                    <legend id="fieldset-basicinfo">
                                        <h5>BASIC INFORMATION</h5>
                                    </legend>


                                    <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                    <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto" style="height: 200px; width:200px;margin:auto;" class="photo img-thumbnail">

                                    <div style="margin:auto">
                                        <div class="col-12" style="margin:auto;margin-top:30px;">
                                     
                                                <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                        
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <label>Select Individual: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 100%;" id="entity1" name=" entity_no" value="">
                                                <option>Select Individual</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-5">
                                            <label>Entity Number : &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" readonly class="form-control" id="entity_number" name="entity_number" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity Number">
                                        </div>

                                    </div><br>


                                    <div class="row">

                                        <div class="col-sm-3">
                                            <label>First name: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="First name">
                                        </div>

                                        <div class="col-sm-3">
                                            <label>Middle name: </label>
                                            <input type="text" class="form-control" id="middlename" name="middlename" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Middle name">

                                        </div>
                                        <div class="col-sm-3">
                                            <label>Last name : &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Last name">
                                        </div>
                                        <div class="col-sm-3">

                                            <label>Extension name: </label>
                                            <input type="text" class="form-control" id="suffix" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" name="suffix" placeholder="Extension name">

                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Gender: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender"> -->
                                            <select class="form-control select2" id="gender" name="gender">
                                                <option selected value=" ">Select gender</option>
                                                <option value="01_Female">Female</option>
                                                <option value="02_Male">Male</option>
                                                <option value="03_Not to disclose"> Not to Disclose</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label>Birthdate: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                                        </div>

                                        <div class="col-sm-3">
                                            <label>Civil Status: </label>
                                            <select class="form-control select2" style="width: 100%;" name="civil_status" id="civil_status">
                                                <option value=" " selected>Select Civil Status</option>
                                                <?php while ($get_civilstatus = $get_all_civilstatus_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_civilstatus['description'] ?>"><?php echo $get_civilstatus['name_civilstatus']; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Contact No: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number">
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Employed : &nbsp;&nbsp; <span id="required">*</span></label>
                                            <select class="form-control select2" style="width: 100%;" name="emp_status" id="emp_status">
                                                <option value="">Please select...</option>
                                                <?php while ($get_employment = $get_all_employment_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_employment['description']  ?>"><?php echo $get_employment['status']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Profession :&nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 100%;" name="profession" id="profession">
                                                <option selected value="">Select Profession</option>
                                                <?php while ($get_profession = $get_all_profession_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_profession['description'] ?>"><?php echo $get_profession['profession']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div><br>
                                </fieldset><br>


                                <!-- category -->
                                <fieldset class="form-control field_set">
                                    <legend id="fieldset-category">
                                        <h5>CATEGORY</h5>
                                    </legend>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="">Category: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <!-- <select class="form-control select2" style="width: 100%;" name="category" id="category">
                                                <option value=" " selected>Select Category</option>
                                                <?php while ($get_category = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_category['description'] ?>"><?php echo $get_category['category']; ?></option>
                                                <?php } ?>
                                            </select> -->

                                            <select class="form-control select2" style="width:100%" name="category" id="category">
                                                <option value=" " selected> Select Category </option>
                                                <option value="01_Health_Care_Worker">Health Care Worker</option>
                                                <option value="02_Senior_Citizen">Senior Citizen</option>
                                                <option value="03_Indigent">Indigent</option>
                                                <option value="04_Uniformed_Personnel">Uniformed_Personnel</option>
                                                <option value="05_Essential_Worker">Essential_Worker</option>
                                                <option value="06_Other">Other</option>

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
                                                <?php while ($get_category_id = $get_all_category_id_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_category_id['description'] ?>"><?php echo $get_category_id['categ_id_type']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" id="healthworker" >
                                            <label for="">Type of Health Worker: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <select class="form-control select2" style="width: 100%;" id="health_worker" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name="health_worker" value="">
                                                <option value=" " selected>Select Health Worker</option>
                                                <?php while ($get_healthworkers = $get_all_healthworkers_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_healthworkers['idno'] ?>"><?php echo $get_healthworkers['description']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>







                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>ID Number: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" id="idno" name="idno" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="ID Number">
                                        </div>

                                        <div class="col-sm-4">
                                            <label>Philhealth ID : &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Philhealth ID">
                                            <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if no PhilHealth ID #</i></span>
                                        </div>


                                        <div class="col-sm-4">
                                            <label>PWD ID : </label>
                                            <input type="text" class="form-control" id="pwd_id" name="pwd_id" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="PWD ID">
                                            <span id="asstdname"> &nbsp;&nbsp;<i>Type N/A if no PWD ID #</i></span>
                                        </div>

                                    </div><br>
                                </fieldset><br>


                          
                                <!-- end of basic information -->


                                <!-- address -->
                                <fieldset class="form-control field_set">

                                    <legend id="fieldset-category">
                                        <h5>ADDRESS</h5>
                                    </legend>

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
                                            <input type="text" class="form-control" id="barangay" name="barangay" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Barangay">
                                        </div>

                                        <div class="col-sm-8">
                                            <label for="">Complete Address: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class=" form-control" name="street" id="street" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Street / Block # / Lot #    ">
                                        </div>
                                    </div><br>

                                </fieldset><br>
                                <!-- end of address -->


                                <!--  employer -->
                                <fieldset class="form-control field_set">

                                    <legend id="fieldset-category">
                                        <h5>EMPLOYER</h5>
                                    </legend>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Employer Name: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" name="name_employeer" id="name_employeer" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Name of employeer">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Employer Address: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" name="emp_address" id="emp_address" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Street / Lot # / Block # ">

                                        </div>


                                    </div> <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>LGU: &nbsp;&nbsp; <span id="required">*</span> </label>

                                            <input type="text" class="form-control" name="emp_lgu" id="emp_lgu" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="LGU">

                                        </div>
                                        <div class="col-sm-6">
                                            <label>Contact Number: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="number" class="form-control" name="emp_contact" id="emp_contact" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Contact Number">
                                        </div>
                                    </div><br>

                                </fieldset><br>
                                <!-- end of employer fieldset -->


                                <!-- medical conditions -->
                                <fieldset class="form-control field_set">
                                    <legend id="fieldset-medical">
                                        <h5>MEDICAL CONDITIONS</h5>
                                    </legend>
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <label> If female, pregnancy status?</label>
                                            <select class="form-control select2" style="width:100%" name="preg_status" id="preg_status">
                                                <option selected> Select pregnancy status... </option>
                                                <option value="01_Pregnant">Pregnant</option>
                                                <option value="02_Not_Pregnant">Not Pregnant</option>
                                            </select>

                                        </div>

                                        <div class="col-sm-3">
                                            <label>With Allergy? </label>
                                            <select class="form-control  " name="with_allergy" id="with_allergy" style="width:100%">
                                                <option value="01_Yes">Yes</option>
                                                <option selected value="02_No">None</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label>With Comorbidities?</label>
                                            <select class="form-control " style="width:100%" name="with_commorbidities" id="with_commorbidities">
                                                <option value="01_Yes">Yes</option>
                                                <option selected value="02_No">None</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label> COVID History? &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control " style="width:100%" name="patient_diagnose" id="patient_diagnose">
                                                <option value="01_Yes">Yes</option>
                                                <option selected value="02_No">No</option>
                                            </select>
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Directly in interaction with COVID patient &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control" name="interact_patient" id="interact_patient">
                                                <option value="01_Yes">Yes</option>
                                                <option selected value="02_No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Provided Electronic Informed Consent &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control" name="electronic_consent" id="electronic_consent">
                                                <option value="01_Yes">Yes</option>
                                                <option selected value="02_No">No</option>
                                                <option selected value="03_Unknown">Unknown</option>
                                            </select>
                                        </div>
                                    </div><br>

                                </fieldset><br>
                                <!-- end of medical conditions -->


                                <!-- kung yes ang covid history -->
                                <fieldset class="form-control field_set" hidden id="yes-diagnose">
                                    <legend id="fieldset-comorbidity">
                                        <h5>COVID HISTORY</h5>
                                    </legend>
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
                                </fieldset><br>
                                <!-- end of yes form sa covid history -->



                                <!-- if yes kung naay allergy -->
                                <fieldset class="form-control field_set" hidden id="yes-allergy">
                                    <legend id="fieldset-category">
                                        <h5>ALLERGY</h5>
                                    </legend>
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




                                </fieldset><br>
                                <!-- end sa choices sa form sa allergies -->


                                <!-- if yes kung with comorbidities -->
                                <fieldset class="form-control field_set" hidden id="yes-comordities">
                                    <legend id="fieldset-comorbidity">
                                        <h5>COMORBIDITY</h5>
                                    </legend>

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

                                </fieldset><br>
                                <!-- end of form choices comorbidities -->


                                <div class="box-footer" align="center">
                                    <button type="submit" id="btnSubmit" name="insert_vaccine" class="btn btn-success">
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

                        if (gender == 'Female'){
                            $("#gender").select2("val", "01_Female");
                        }else if (gender == 'Male'){
                            $("#gender").select2("val", "02_Male");
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
        $('#gender').change(function() {
            var option = $('#gender').val();
            if (option == "01_Pregnant") {
                $('#pregnant').prop("hidden", false);



            } else {

                $('#pregnant').prop("hidden", true);

            }

            console.log("test");
        });


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