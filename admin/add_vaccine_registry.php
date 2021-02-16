<?php


include('../config/db_config.php');
// include('insert_vaccine.php');
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
            <!-- 
            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div> -->

            <section class="content">
                <div class="card">

                    <div class="card-header p-2 bg-success text-white">
                        <div class="nav nav-pills" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true">PROFILE</a>
                            <a class="nav-item nav-link " id="nav-employee-tab" data-toggle="tab" href="#nav-employee" role="tab" aria-controls="nav-employee" aria-selected="true">EMPLOYMENT</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-clinic" role="tab" aria-controls="nav-clinic" aria-selected="false">CLINICAL INFO </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-exposure" role="tab" aria-controls="nav-exposure" aria-selected="false">EXPOSURE DETAILS</a>
                            <a class="nav-item nav-link" id="nav-health-tab" data-toggle="tab" href="#nav-attestation" role="tab" aria-controls="nav-attestation" aria-selected="false">ATTESTATION</a>
                            <!-- <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel" aria-selected="false">TRAVEL HISTORY</a> -->

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="box-body">
                            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="insert_vaccine.php">

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div>



                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label>Date Registered: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" readonly class="form-control pull-right" style="width: 90%;" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label> Time Registered:</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input readonly type="text" class="form-control" style="text-align:center;" name="time" id="time" placeholder="Time Registered" value="<?php echo $time; ?>" required>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label>Select Individual : </label>
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width: 100%;" id="entity1" name=" entity_no" value="">
                                                        <option>Select Individual</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label>Entity # : </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" readonly class="form-control" id="entity_number" name="entity_number" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity #">
                                                </div>


                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label for="">Category of the Target <br> Eligible Population:</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width:100%;" name="category" id="category">
                                                        <option selected="selected">Select Category</option>
                                                        <?php while ($get_category = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_category['idno']; ?>"><?php echo $get_category['category']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label for="">ID Number depending on the category type:</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width: 100%;" id="category_id" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" name="category_id" value="">
                                                        <option>Select Category ID</option>
                                                        <?php while ($get_category_id = $get_all_category_id_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_category_id['idno']; ?>"><?php echo $get_category_id['categ_id_type']; ?></option>
                                                        <?php } ?>
                                                    </select>


                                                </div>



                                            </div><br>




                                            <div class="row">


                                                <div class="col-md-2" align="right">
                                                    <label>Philhealth ID : </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Philhealth Id">
                                                </div>
                                                <div class="col-md-2" align="right">
                                                    <label>ID Number: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" id="idno" name="idno" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="ID Number">
                                                </div>
                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label>Lastname : </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="lastname" name="lastname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Lastname">
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label>Gender: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label>Firstname: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="firstname" name="firstname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Firstname">
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label>Birthdate: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label>Middlename: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="middlename" name="middlename" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Middlename">
                                                </div>
                                                <div class="col-md-2" align="right">
                                                    <label>Civil Status: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width: 100%;" name="civil_status" id="civil_status">
                                                        <option>Select Civil Status</option>
                                                        <?php while ($get_civilstatus = $get_all_civilstatus_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_civilstatus['idno']; ?>"><?php echo $get_civilstatus['name_civilstatus']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label>Suffix: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="suffix" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" name="suffix" placeholder="Suffix">
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label>Contact No: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number">
                                                </div>
                                            </div><br>




                                            <div class="row">
                                                <div class="col-md-2" align="right">
                                                    <label for="">Complete Address:</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="text" class=" form-control" name="street" id="street" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Street / Block # / Lot #    ">

                                                </div>

                                                <div class="col-md-4">

                                                    <input type="text" class="form-control" id="barangay" name="barangay" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Barangay">


                                                </div>

                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="city" placeholder="City" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" value="<?php echo $city ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="province" placeholder="Province" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" value="<?php echo $province ?>">
                                                </div>
                                            </div><br>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-employee" role="tabpanel" aria-labelledby="nav-employee  -tab">
                                        <div>


                                            <div class="row">
                                                <div class="col-sm-3" align="right">
                                                    <label>Employment Status : </label>
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width: 100%;" name="emp_status" id="emp_status">
                                                        <option value="">Select Employment Status</option>
                                                        <?php while ($get_employment = $get_all_employment_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_employment['idno']; ?>"><?php echo $get_employment['status']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label>Profession : </label>
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width: 100%;" name="profession" id="profession">
                                                        <option selected value="">Select Profession</option>
                                                        <?php while ($get_profession = $get_all_profession_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_profession['idno']; ?>"><?php echo $get_profession['profession']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div><br>



                                            <div class="row">
                                                <div class="col-md-3" align="right">
                                                    <label>Name of Employer : </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="name_employeer" id="name_employeer" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Name of employeer">
                                                </div>

                                                <div class="col-md-2" align="right">
                                                    <label>Contact Number: </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="emp_contact" id="emp_contact" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Contact Number">
                                                </div>
                                            </div> <br>



                                            <div class="row">
                                                <div class="col-md-3" align="right">
                                                    <label for="">Complete Address:</label>
                                                </div>

                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" style="width:100%;" name="emp_address" id="emp_address" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Street / Lot # / Block # / Barangay / City / Province">
                                                    
                                                </div>

                                            </div><br>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-clinic" role="tabpanel" aria-labelledby="nav-clinic-tab">
                                        <div>



                                            <div class="row">

                                                <div class="col-md-3" align="right">
                                                    <label> If female, pregnancy status?</label>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                &nbsp;
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width:100%" name="preg_status" id="preg_status">
                                                        <option selected value=""> Select pregnancy status </option>
                                                        <option value="01">Pregnant</option>
                                                        <option value="02">Not Pregnant</option>
                                                    </select>

                                                </div>
                                            </div><br>



                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label>With Allergy? </label>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"> </div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2 " name="with_allergy" id="with_allergy" style="width:100%">
                                                        <option selected value="">Do you have allergy?</option>
                                                        <option value="01">Yes</option>
                                                        <option value="02">None</option>
                                                    </select>
                                                </div>
                                            </div><br>




                                            <div id="yes-allergy" hidden>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-2">
                                                        <label>Name of Allergy? </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>

                                                    <div class="col-md-4">
                                                        <select name="name_allergy" id="name_allergy" style="width:100%" class="form-control select2">
                                                            <option value="">Select Name of Allergy</option>

                                                            <?php while ($get_allergy = $get_all_allergy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                <option value="<?php echo $get_allergy['idno']; ?>"><?php echo $get_allergy['allergy']; ?></option>
                                                            <?php } ?>

                                                        </select>


                                                    </div>
                                                </div><br>



                                            </div>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                    <div class="col-md-2">
                                                    <label>With Comorbidities?</label>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width:100%" name="with_commorbidities" id="with_commorbidities">
                                                        <option selected value="">Do you have comorbidites?</option>
                                                        <option value="01">Yes</option>
                                                        <option value="02">None</option>
                                                    </select>

                                                </div>
                                            </div><br>


                                            <div id="yes-comordities" hidden>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-2">
                                                        <label>Name of Comorbidity?</label>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-4">
                                                        <select class="form-control select2" multiple="" name="name_comorbidities[]" style="width:100%" id="name_comorbidities">
                                                            <option value="">Name of Comorbidites</option>

                                                            <?php while ($get_comorbidity = $get_all_comorbidites_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                <option value="<?php echo $get_comorbidity['idno']; ?>"><?php echo $get_comorbidity['comorbidity']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div><br>
                                            </div>
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
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width:100%" name="patient_diagnose" id="patient_diagnose">
                                                        <option selected value="">Please select</option>
                                                        <option value="01">Yes</option>
                                                        <option value="02">No</option>
                                                    </select>
                                                </div>
                                            </div><br>



                                            <div id="yes-diagnose" hidden>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label>Date of first positive result/ specimen collection? &nbsp;&nbsp; <span id="required">*</span> </label>
                                                        <input type="date" id="date_positive" name="date_positive" class="form-control pull-right " placeholder="dd/mm/yyyy" />
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <label>Classification of infection?</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>

                                                    <div class="col-md-4">
                                                        <select name="name_infection" id="name_infection" style="width:100%" class="form-control select2">
                                                            <option value="">Classification of Allergy</option>
                                                            <?php while ($get_infection = $get_all_infection_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                <option value="<?php echo $get_infection['idno']; ?>"><?php echo $get_infection['classification']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div><br>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="nav-attestation" role="tabpanel" aria-labelledby="nav-attestation-tab">
                                        <div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-8">
                                                    <label for="">Are you willing to be vaccinated?</label>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2" style="width:100%" name="consentation" id="consentation">
                                                        <option selected value="">Please select</option>
                                                        <option value="01">Yes</option>
                                                        <option value="02">No</option>
                                                        <option value="03">Unknown</option>

                                                    </select>

                                                </div>
                                            </div><br>

                                        </div>

                                        <div class="box-footer" align="center">


                                            <button type="submit" id="btnSubmit" name="insert_vaccine" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button>

                                            <a href="list_vaccine_profile">
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
                        $('#gender').val(result.data10);
                        $('#contact_no').val(result.data12);
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
            if (option == "01") {
                $('#pregnant').prop("hidden", false);



            } else {

                $('#pregnant').prop("hidden", true);

            }

            console.log("test");
        });



        $('#with_allergy').change(function() {
            var option = $('#with_allergy').val();
            if (option == "01") {
                $('#yes-allergy').prop("hidden", false);



            } else {

                $('#yes-allergy').prop("hidden", true);

            }

            console.log("test");
        });


        $('#with_commorbidities').change(function() {
            var option = $('#with_commorbidities').val();
            if (option == "01") {
                $('#yes-comordities').prop("hidden", false);



            } else {

                $('#yes-comordities').prop("hidden", true);

            }

            console.log("test");
        });


        $('#patient_diagnose').change(function() {
            var option = $('#patient_diagnose').val();
            if (option == "01") {
                $('#yes-diagnose').prop("hidden", false);



            } else {

                $('#yes-diagnose').prop("hidden", true);

            }

            console.log("test");
        });
    </script>


</body>

</html>