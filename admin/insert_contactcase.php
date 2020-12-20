<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_contactcase'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    //insert to tbl_individual


    //TRACER INFO
    $date_register = $_POST['date_register1'];
    $time_register = $_POST['time'];
    $tracer_name = $_POST['contact_tracer'];
    $brgy_contacttracer = $_POST['brgy_contacttracer'];

    //COVID INFO
    $case_invest       = $_POST['case_investigation'];
    $placeorigin       = $_POST['name_lsi'];

    $index_id       = $_POST['index_no'];
    $index_name     = $_POST['patient_name'];

    //PERSONAL INFORMATION
    $patient_entityno = $_POST['entity_no7'];
    $patient_idno       = $_POST['patient_no'];
    $patient_fullname   = $_POST['fullnamess'];
    $patient_street     = $_POST['street'];
    $patient_barangay   = $_POST['barangay'];
    $patient_bday       = date('Y-m-d', strtotime($_POST['birthdate']));
    $patient_age        = $_POST['age'];
    $patient_gender     = $_POST['gender'];
    $patient_mobile     = $_POST['mobile_no'];
    $permament_add     = $_POST['permanent_add'];
    $house_no           = $_POST['house_no'];
    $longtitude         = $_POST['longtitude'];
    $latitude           = $_POST['latitude'];
    $occupation         = $_POST['occupation'];
    $placeofwork        = $_POST['placeofwork'];
    $healthworker       = $_POST['healthworker'];
    $phil_no            = $_POST['phil_no'];
    $blood_type         = $_POST['blood_type'];
    $marital_status     = $_POST['marital_status'];
    $nationality        = $_POST['nationality'];
    $passport           = $_POST['passport'];
    $householdno        = $_POST['household_member'];
    $outside_ofw        = $_POST['ofw'];
    $ofw_name           = $_POST['ofw_name'];
    $ofw_occupation     = $_POST['ofw_occupation'];
    $ofw_placeofwork    = $_POST['ofw_placeofwork'];
    $ofw_buidlingname   = $_POST['ofw_buidlingname'];
    $ofw_street         = $_POST['ofw_street'];
    $ofw_city           = $_POST['ofw_city'];
    $ofw_state          = $_POST['ofw_state'];
    $ofw_country        = $_POST['ofw_country'];
    $ofw_phoneno        = $_POST['ofw_phoneno'];
    $ofw_mobileno       = $_POST['ofw_mobileno'];

    // EXPOSURE OF COVID DETAILS
    $history_exposure   = $_POST['exposure'];
    $date_exposure      = date('Y-m-d', strtotime($_POST['date_exposure']));
    $place_covid        = $_POST['transmission_name'];
    $place_been         = $_POST['other_trans'];
    $facility_name      = $_POST['facility_name1'];
    $date_visit         = date('Y-m-d', strtotime($_POST['date_visit']));
    $placename          = $_POST['name_place'];

    // PERSONS NAME

    $personentity1      = $_POST['person_entity1'];
    $personname1        = $_POST['person_fullname1'];
    $personentity2      = $_POST['person_entity2'];
    $personname2        = $_POST['person_fullname2'];
    $personentity3      = $_POST['person_entity3'];
    $personname3        = $_POST['person_fullname3'];
    $personentity4      = $_POST['person_entity4'];
    $personname4        = $_POST['person_fullname4'];
    $personentity5      = $_POST['person_entity5'];
    $personname5        = $_POST['person_fullname5'];

    //CLINICAL INFORMATION
    $disposition    = $_POST['disposition'];

    $date_illness   = $_POST['date_illness'];
    $get_quaran     = $_POST['get_typess'];
    $date_swab      = date('Y-m-d', strtotime($_POST['sched_date']));
    $reasons_swab   = $_POST['reason_swabbing'];
    $lockdown       = $_POST['lockdown'];

    $date_quaran    = $_POST['date_quarans'];
    $travel         = $_POST['travel'];
    $port_exit      = $_POST['travel'];
    $airline        = $_POST['airline'];
    $flight_no      = $_POST['flight_no'];

    if (empty($_POST['signs_symptoms'])) {
        $health_symptoms = '';
    } else {
        $health_symptoms  =  implode(",", $_POST['signs_symptoms']);
    }

    $remarks = 'PENDING';

    $insert_closecontact_sql = "INSERT INTO tbl_closecontact SET 
    date_register = :date_register,
    time_register = :time_register,

    tracer_name           = :tracer_name,
    brgy_contacttracer    = :brgy_contacttracer,
    
    case_investigation    = :invest_case,
    place_origin          =:orig_place,
    index_id              = :index_id,
    index_name            = :index_name,

    patient_id            = :id,
    patient_fullname      = :fullname,
    patient_street        = :street,
    patient_barangay      = :brgy,
    patient_bday          =:bday,
    patient_age           =:age,
    patient_gender      =:gender,
    patient_mobile      =:mobile,
    permanent_add       = :address_perm,
    house_no            = :no_house,
    longtitude          = :no_longtitude,
    latitude            = :no_latitude,
    occupation          = :occupations,
    placeofwork         = :placeof_work,
    healthworker        = :health_worker,
    phil_no             = :no_phil,
    blood_type          = :type_blood,
    maritalstatus       = :marital,
    nationality         = :national,
    householdno         = :nohousehold,
    outside_ph              =:ph_outside,
    employee_name           =:name_emp,
    ofw_occupation          =:ofw_occ,
    ofw_placework           =:ofw_work,
    ofw_buildingname        =:ofw_bldg,
    ofw_street              =:street_ofw,
    ofw_city                =:city_ofw,
    ofw_state               =:state_ofw,
    ofw_country             =:count_ofw,
    ofw_phoneno             =:phone_ofw,
    ofw_mobileno            =:mobile_ofw,

    history_exposure    = :hist_exp,
    date_exposure       = :date_exp,
    place_covid         = :placecovid,
    place_been          = :placebeen,
    facility_name       = :facilityname,
    date_visit          = :visit_date,
    placename           = :place_name,
    personentity1       =:pentity1,
    personfullname1     =:pname1,
    personentity2       =:pentity2,
    personfullname2     =:pname2,
    personentity3       =:pentity3,
    personfullname3     =:pname3,
    personentity4       =:pentity4,
    personfullname4     =:pname4,
    personentity5       =:pentity5,
    personfullname5     =:pname5,

    disposition         =:disp,
    date_illness        =:illness,
    quarantine_type     =:qaur,
    date_swab           =:swab_date,
    reason_swabbing    =:reasons_swab,
    date_quarantine     =:quara_date,
    lockdown            =:lockdowns,
    travel              =:traveel,
    travel_port_exit    =:port_exit,  
    travel_airline      =:airline,
    travel_flight       =:flight_no,
    symptoms_signs      =:signs,
    status              =:staaus




    ";

    $closecontact_data = $con->prepare($insert_closecontact_sql);
    $closecontact_data->execute([
        //TRACER
        ':date_register'         => $date_register,
        'time_register'          => $time_register,
        ':tracer_name'           => $tracer_name,
        ':brgy_contacttracer'    => $brgy_contacttracer,

        //COVID INFO.
        ':invest_case'          => $case_invest,
        ':orig_place'           => $placeorigin,
        ':index_id'              => $index_id,
        ':index_name'            => $index_name,

        //patient information
        ':id'               => $patient_idno,
        ':fullname'         => $patient_fullname,
        ':street'           => $patient_street,
        ':brgy'             => $patient_barangay,
        ':bday'             => $patient_bday,
        ':age'              => $patient_age,
        ':gender'           => $patient_gender,
        ':mobile'           => $patient_mobile,
        ':address_perm'     => $permament_add,
        ':no_house'         => $house_no,
        ':no_longtitude'    => $longtitude,
        ':no_latitude'      => $latitude,
        ':occupations'      => $occupation,
        ':placeof_work'     => $placeofwork,
        ':health_worker'    => $healthworker,
        ':no_phil'          => $phil_no,
        ':type_blood'       => $blood_type,
        ':marital'          => $marital_status,
        ':national'         => $nationality,
        ':nohousehold'      => $householdno,
        ':ph_outside'       => $outside_ofw,
        ':name_emp'         => $ofw_name,
        ':ofw_occ'          => $ofw_occupation,
        ':ofw_work'         => $ofw_placeofwork,
        ':ofw_bldg'         => $ofw_buidlingname,
        ':street_ofw'       => $ofw_street,
        ':city_ofw'         => $ofw_city,
        ':state_ofw'        => $ofw_state,
        ':count_ofw'        => $ofw_country,
        ':phone_ofw'        => $ofw_phoneno,
        ':mobile_ofw'       => $ofw_mobileno,

        // EXPOSURE DETAILS
        ':hist_exp'         => $history_exposure,
        ':date_exp'         => $date_exposure,
        ':placecovid'       => $place_covid,
        ':placebeen'        => $place_been,
        ':facilityname'     => $facility_name,
        ':visit_date'       => $date_visit,
        ':place_name'       => $placename,
        ':pentity1'         => $personentity1,
        ':pname1'           => $personname1,
        ':pentity2'         => $personentity2,
        ':pname2'           => $personname2,
        ':pentity3'         => $personentity3,
        ':pname3'           => $personname3,
        ':pentity4'         => $personentity4,
        ':pname4'           => $personname4,
        ':pentity5'         => $personentity5,
        ':pname5'           => $personname5,

        ':disp'                 => $disposition,
        ':illness'              => $date_illness,
        ':qaur'                 => $get_quaran,
        ':swab_date'            => $date_swab,
        ':reasons_swab'         => $reasons_swab,
        ':quara_date'           => $date_quaran,
        ':lockdowns'            => $lockdown,
        ':traveel'              => $travel,
        ':port_exit'            => $port_exit,
        ':airline'              => $airline,
        ':flight_no'            => $flight_no,
        ':signs'                => $health_symptoms,
        ':staaus'               => $remarks










    ]);





    // $insert_notif_sql = "INSERT INTO tbl_notification SET 
    // title           = :title,
    // entity_no           = :entity_no,
    // message             = :message,
    // date                = :date,
    // status                = :status,

    // time                = :time 
    // ";

    // $notif_data = $con->prepare($insert_notif_sql);
    // $notif_data->execute([
    //     ':title'         => $title,
    //     ':entity_no'         => $patient_id,
    //     ':message'           => $message,
    //     ':date'              => $datereg,
    //     ':status'              => $status,

    //     ':time'              =>  $time

    // ]);




    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
        </div>    
      ';



    //echo print_r($firstname);


}
