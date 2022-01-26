<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_sources_infection'])) {

    $remarks            = 'Positive';
    $status             = 'UNREAD';
    $new_positive       = 'NEW';
    $title              = 'SWAB TEST RESULT';
    $date_reg           = date('Y-m-d', strtotime($_POST['date_register']));
    $time               = $_POST['time'];
    $tracer_name        = $_POST['contact_tracer'];
    $brgy_tracer        = $_POST['brgy_contacttracer'];
    $close_contact      = $_POST['close_contact'];
    $index_entity       = $_POST['index_entity'];
    $index_name         = $_POST['index_case'];
    $index_relation     = $_POST['index_relation'];
    $date_expose        = date('Y-m-d', strtotime($_POST['date_exposure']));

    $patient_no         = $_POST['patient_no'];
    $entity_no          = $_POST['entity_no1'];
    $firstname          = $_POST['first_name'];
    $middlename         = $_POST['middle_name'];
    $lastname           = $_POST['last_name'];
    $fullname           = $_POST['last_name'] . ', ' . $_POST['first_name'] . ' ' . $_POST['middle_name'] . '.';
    $birthdate          = date('Y-m-d', strtotime($_POST['birthdate']));
    $age                = $_POST['age'];
    $gender             = $_POST['gender'];
    $barangay           = $_POST['barangay'];
    $street             = $_POST['street'];
    $city               = $_POST['city'];
    $province           = $_POST['province'];
    $place_origin       = $_POST['place_orig'];
    $place_admission    = $_POST['place_admiss'];
    $date_admission     = date('Y-m-d', strtotime($_POST['date_admiss']));
    $mobile_no          = $_POST['mobile_no'];
    $blood_type         = $_POST['blood_type'];
    $civil_status       = $_POST['marital_status'];
    $nationality        = $_POST['nationality'];
    $occupation         = $_POST['occupation'];
    $workplace          = $_POST['workplace'];
    $household_member   = $_POST['household_member'];
    $comorbidities      = $_POST['comorbidities'];


    if (empty($_POST['signs_symptoms'])) {
        $health_symptoms = '';
    } else {
        $health_symptoms  =  implode(",", $_POST['signs_symptoms']);
    }

    $date_swab          = date('Y-m-d', strtotime($_POST['date_swab']));
    $reasons_swabbing   = $_POST['reasons_swab'];
    $quarantine_started = date('Y-m-d', strtotime($_POST['quaratine_started']));
    $type_quarantine    = $_POST['get_type'];


    $message = $title . 'Good day!' . $fullname . '. 
            Your Lab Results indicate that you are COVID-19 POSITIVE for SARS-COV-2. You will be contacted shortly 
            by a representative from our Local Govt, DOH or another government agency. Do not travel or leave the house. 
            1. Remain calm. 
            2. Please stay at home and isolate yourself from other people at least 2 meters distance, do not go out. 
            3. Have your own utensils for food, have your mask at all times and do not share your personal belongings with others.';

    $insert_infection_sql = "INSERT INTO tbl_sources_infection SET 
        date_register        = :date_reg,
        time_register        = :time_reg,
        remarks              = :remarks,
        tracer_fullname      = :tracer_name,
        tracer_brgy          = :tracer_brgy,
        close_contact        = :close_contact,
        index_entityNo       = :index_entity,
        index_name           = :index_name,
        index_relation       = :index_relation,
        index_date           = :index_date,
        patient_entityno     = :entity_no,
        patient_no           = :patient_no,
        patient_fullname     = :fullname,
        patient_firstname    = :firstname,
        patient_middlename   = :middlename,
        patient_lastname     = :lastname,
        patient_birthdate    = :bdate,
        patient_age          = :age,
        patient_gender       = :gender,
        patient_barangay     = :barangay,
        patient_street       = :street,
        patient_city         = :city,
        patient_province     = :province,
        patient_origin       = :origin,
        patient_admission    = :admission,
        date_admission       = :date_admission,
        patient_mobileno     = :mobile_no,
        patient_bloodtype    = :blood_type,
        patient_civilstat    = :civil_status,
        patient_nationality  = :nationality,
        patient_occupation   = :occupation,
        patient_workplace    = :workplace,
        patient_member       = :household_member,
        health_comorbidities = :comorbidities,
        health_symptoms      = :symptoms,
        date_swab            = :swab,
        health_swabbing      = :reasons_swab,
        quarantine_started   = :quara_started,
        health_quarantine    = :type_quarantine,
        status               = :stat_new
  
    ";

    $infection_data = $con->prepare($insert_infection_sql);
    $infection_data->execute([
        ':date_reg'         => $date_reg,
        ':time_reg'         => $time,
        ':remarks'          => $remarks,
        ':tracer_name'      => $tracer_name,
        ':tracer_brgy'      => $brgy_tracer,
        ':close_contact'    => $close_contact,
        ':index_entity'     => $index_entity,
        ':index_name'       => $index_name,
        ':index_relation'   => $index_relation,
        ':index_date'       => $date_expose,
        ':patient_no'       => $patient_no,
        ':entity_no'        => $entity_no,
        ':fullname'         => $fullname,
        ':firstname'        => $firstname,
        ':middlename'       => $middlename,
        ':lastname'         => $lastname,
        ':bdate'            => $birthdate,
        ':age'              => $age,
        ':gender'           => $gender,
        ':barangay'         => $barangay,
        ':street'           => $street,
        ':city'             => $city,
        ':province'         => $province,
        ':origin'           => $place_origin,
        ':admission'        => $place_admission,
        ':date_admission'   => $date_admission,
        ':mobile_no'        => $mobile_no,
        ':blood_type'       => $blood_type,
        ':civil_status'     => $civil_status,
        ':nationality'      => $nationality,
        ':occupation'       => $occupation,
        ':workplace'        => $workplace,
        ':household_member' => $household_member,
        ':comorbidities'    => $comorbidities,
        ':symptoms'         => $health_symptoms,
        ':swab'             => $date_swab,
        ':reasons_swab'     => $reasons_swabbing,
        ':quara_started'    => $quarantine_started,
        ':type_quarantine'  => $type_quarantine,
        ':stat_new'         => $new_positive

    ]);


    $insert_notif_sql = "INSERT INTO tbl_notification SET 

        entity_no           = :entity_no,
        message             = :message,
        date                = :date,
        time                = :time


        ";

    $notif_data = $con->prepare($insert_notif_sql);
    $notif_data->execute([

        ':entity_no'         => $entity_no,
        ':message'           => $message,
        ':date'              => $date_reg,
        ':time'              => $time

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
        </div>    
      ';

    $btn_enabled = 'disabled';
    $btnNew = 'enabled';
    $btnPrint = 'enabled';


    //echo print_r($firstname);


}
