<?php


include('../config/db_config.php');
include('insert_individual.php');
session_start();

$now = new DateTime();
$time = date(' H:i');


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


    $db_fullname = $result['fullname'];
}



// include('verify_admin.php');

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();


// $get_all_individual_sql = "SELECT * FROM tbl_individual ";
// $get_all_individual_data = $con->prepare($get_all_individual_sql);
// $get_all_individual_data->execute();


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
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-tracer" role="tab" aria-controls="nav-home" aria-selected="true">CONTRACT TRACER</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">CLOSE CONTACT </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">PATIENT PROFILE </a>
                            <a class="nav-item nav-link" id="nav-health-tab" data-toggle="tab" href="#nav-health" role="tab" aria-controls="nav-health" aria-selected="false">HEALTH STATUS</a>
                            <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel" aria-selected="false">TRAVEL HISTORY</a>

                        </div>
                    </div>



                    <div class="card-body">
                        <div class="box-body">

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-tracer" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                            <input type="text" class="form-control" name="contact_tracer" style=" text-transform: uppercase;" id="contact_tracer" placeholder="Investigator's Name" value="<?php echo $db_fullname ?>" required>
                                            <span id="asstdname"> &nbsp;&nbsp;<i>Name of Contact Tracer</i></span>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="col-md-3">
                                            <label for="">Name of Brgy Contact Tracer: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" name="brgy_contacttracer" style=" text-transform: uppercase;" id="brgy_contacttracer" placeholder="Name of Brgy Contact Tracer" value="" required>
                                            <span id="asstdname"> &nbsp; &nbsp;<i>Please put NONE if no Brgy CT assisted</i></span>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Close Contact?: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <select class=" form-control select2" style="width: 100%;" id="close_contact" name="close_contact" value="" required>
                                                <option selected="selected">Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>


                                    </div>


                                </div>

                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <label>If YES, who is the Index Case: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" id="index_case" name="index_case" placeholder="Index Case Name" required>

                                        </div>

                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-1"> </div>
                                        <div class="col-md-5">
                                            <label>If YES, what is your RELATIONSHIP of Index Case: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" id="index_relation" name="index_relation" placeholder="Relationship of Index Case" required>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <label for="">If YES, when was the LAST DAY OF EXPOSURE TO THE CONFIRMED CASE? &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="date" id="date_exposure" name="date_exposure" style="width: 100%;" value="" class="form-control " placeholder="dd/mm/yyyy" />

                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <!-- //PRINT 2 -->
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label> Select Individual: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="entity1" name=" entity_no" value="<?php echo $entity_no; ?>">
                                                <option>Select Individual</option>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">Entity ID: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" readonly class="form-control" id="entity_no1" name="entity_no1" placeholder="entity_no" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Patient #: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" readonly name="patient_no" id="patient_no" placeholder="Patient #" value="" required>
                                        </div>


                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">First Name: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" style=" text-transform: uppercase;" placeholder="First Name" value="" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Middle Initial: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" name="middle_name" id="middle_name" style="text-transform: uppercase;" placeholder="Middle Initial" value="" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Last Name: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" style="text-transform: uppercase;" placeholder="Last Name" value="" required>
                                        </div>
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
                                            <input type="text" id="street" style=" text-transform: uppercase;" name="street" class="form-control" placeholder="Street" value="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">City: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" id="city" name="city" style=" text-transform: uppercase;" class="form-control" placeholder="City" value="">

                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Province: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" id="province" name="province" style=" text-transform: uppercase;" class="form-control" placeholder="Province" value="">

                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">Mobile #: &nbsp;&nbsp; <span id="required">*</span></label>
                                            <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile #" value="" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Civil Status: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class=" form-control select2" style="width: 100%;" id="marital_status" name="marital_status" value="" required>
                                                <option selected="selected">Select Civil Status</option>
                                                <option value="Married">Married</option>
                                                <option value="Single">Single</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Nationality: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" name="nationality" id="nationality" style=" text-transform: uppercase;" placeholder="Nationality" value="<?php echo $nationality; ?>" required>
                                        </div>



                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">Blood Type: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class=" form-control select2" style="width: 100%;" id="blood_type" name="blood_type" value="" required>
                                                <option selected="selected">Select Blood Type</option>
                                                <option value="A+">A+</option>
                                                <option value="B+">B+</option>
                                                <option value="AB+">AB+</option>
                                                <option value="O+">O+</option>
                                                <option value="A-">A-</option>
                                                <option value="B-">B-</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O-">AB-</option>
                                                <option value="Not Known">Not Known</option>
                                            </select>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Occupation: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" name="occupation" id="occupation" style=" text-transform: uppercase;" placeholder="Occupation" value="" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Workplace: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" name="workplace" id="workplace" style=" text-transform: uppercase;" placeholder="Workplace" value="" required>

                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">No. of Household Members: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" class="form-control" name="household_member" id="household_member" placeholder="No. of Household Members" value="" required>
                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane fade" id="nav-health" role="tabpanel" aria-labelledby="nav-health-tab">
                                    <div class="row">
                                        <div class="col-md-1"> </div>

                                        <div class="col-md-3">
                                            <label>Date of Onset of Illness: </label>
                                            <input type="date" id="date_illness" style="width: 90%;" name="date_illness" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                        </div>

                                        <div class="col-md-3">

                                            <label for="">Do you have a fever?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="fever" name="fever " value="" required>
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">

                                            <label for="">Are you experiencing cough?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="cough" name="cough " value="" required>
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>



                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-3">

                                            <label for="">Experiencing sore throat?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="sore_throat" name="sore_throat" value="" required>
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Colds or cold-like symptoms?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="cold_symptoms" name="cold_symptoms" value="" required>
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Shortness/difficult of breathing?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="breathing" name="breathing" value="" required>
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">Experiencing diarrhea/LBM?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="diarrhea" name="diarrhea " value="" required>
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Date of XRAY: </label>
                                            <input type="date" id="date_xray" style="width: 90%;" name="date_xray" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                            <span id="asstdname"> &nbsp;&nbsp;<i>If XRAY is done.</i></span>

                                        </div>
                                        <div class="col-md-3">
                                            <label>Date of Swab Collection: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="date" id="date_swab" name="date_swab" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" required />
                                        </div>

                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">Reasons for swabbing?: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="reasons_swabbing" name="reasons_swabbing " value="" required>
                                                <option selected>Please select</option>
                                                <option value="Close Contact">Close Contact</option>
                                                <option value="Workplace Requirement">Workplace Requirement</option>
                                                <option value="Pregnancy Requirement">Pregnancy Requirement</option>
                                                <option value="Symptomatic (WENT TO BACOLOD RESPIRATORY OUTPATIENT CENTER)">Symptomatic (WENT TO BACOLOD RESPIRATORY OUTPATIENT CENTER)</option>
                                                <option value="Symptomatic (WENT TO A HOSPITAL/PRIVATE MOLECULAR LABORATORY)">Symptomatic (WENT TO A HOSPITAL/PRIVATE MOLECULAR LABORATORY)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Date of Quarantine started: </label>
                                            <input type="date" id="date_quarantine" name="date_quarantine" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                            <span id="asstdname"> &nbsp;&nbsp;<i>If household is on lockdown</i></span>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Quarantine Type: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <select class="form-control select2" style="width: 90%;" id="type_quarantine" name="type_quarantine " value="" required>
                                                <option selected>Please select</option>
                                                <option value="Health Facility">Health Facility </option>
                                                <option value="Quarantine Facility">Qurantine Facility</option>
                                                <option value="Home Quarantine">Home Quarantine</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>

                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label for="">Address of Quarantine Facility: &nbsp;&nbsp; <span id="required">*</span> </label>
                                            <input type="text" id="add_quarantine" name="add_quarantine" style=" text-transform: uppercase;" class="form-control" placeholder="Same as address" value="" required>
                                        </div>
                                        <div class="col-md-3"></div>


                                    </div><br>

                                </div>

                                <div class="tab-pane fade" id="nav-travel" role="tabpanel" aria-labelledby="nav-travel-tab">

                                    <!-- domestic and international -->
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <label for="">
                                                <h5>A. Domestic and International Travel by Air and Sea</h5>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-1"></div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="col-md-3">
                                            <label for="">Did you travel by Air and Sea? </label>
                                            <select class="form-control select2" style="width: 100%;" id="travel_air" name="travel_air " value="">
                                                <option selected>Please select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span id="asstdname"> &nbsp;&nbsp;<i>If NO, go to Land Transportation</i></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Date: </label>
                                            <input type="date" id="date_quarantine" name="date_quarantine" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="col-md-5">
                                            <label for="">Name of Flight Carrier (Plane)/Sea Vessel - Flight Number? </label>
                                            <input type="text" id="name_flight" name="name_flight" style=" text-transform: uppercase;" class="form-control" placeholder="Name of Flight Carrier" value="">
                                            <span id="asstdname"> &nbsp;&nbsp;<i>Example (Philippine Airlines - PR2310)</i></span>
                                        </div>


                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="col-md-3">
                                            <label for=""> Route </label>
                                            <input type="text" id="route" name="route" style=" text-transform: uppercase;" class="form-control" placeholder="Route" value="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""> Passenger or Crew? </label>
                                            <select class="form-control select2" style="width: 100%;" id="passenger" name="passenger " value="">
                                                <option selected>Please select</option>
                                                <option value="Passenger">Passenger</option>
                                                <option value="Crew">Crew</option>
                                            </select>
                                        </div>
                                    </div><br>









                                    <!-- end of domestic internation -->

                                    <!-- land transportation -->

                                    <!-- end of land transportation -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
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
    <!-- FastClick -->
    <!-- <script src="../plugins/fastclick/fastclick.js"></script> -->
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="../dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- DataTables -->
    <!-- <script src="../plugins/datatables/jquery.dataTables.js"></script> -->
    <script src="../plugins/pixelarity/pixelarity-face.js"></script>
    <!-- <script src="../plugins/pixelarity/pixelarity-faceless.js"></script>
    <script src="../plugins/pixelarity/script-faceless.js"></script> -->
    <!-- <script src="../plugins/pixelarity/jquery.3.4.1.min.js"></script> -->
    <!-- <script src="../plugins/datatables/dataTables.bootstrap4.js"></script> -->
    <!-- Toastr -->
    <!-- <script src="../plugins/toastr/toastr.min.js"></script> -->
    <!-- Select2 -->
    <!-- <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script> -->
    <script src="../plugins/cameracapture/webcam-easy.min.js"></script>
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
    <!-- textarea wysihtml style -->
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <!-- <script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     -->

    <!-- <script src="jpeg_camera/dist/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->

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
                    $('#fullname1').val(result.data1);
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

        });
    </script>
</body>

</html>