<?php

include('../config/db_config.php');


session_start();
date_default_timezone_set('Asia/Manila');

$alert_msg = '';

if (isset($_POST['insert_assessment'])) {


    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // category
    $date_reg       = date('Y-m-d', strtotime($_POST['date_register']));
    $time           = date("h:i:s a");
    
    //basic information
    $entityno        = $_POST['entity_number'];
   
    //medical conditions

    if ($_POST['preg_semester'] != 'Select pregnancy status...') {
        $preg_status    = $_POST['preg_status'];
    } else {
        $preg_status = '02_Not_Pregnant';
    }

    if ($_POST['preg_status'] != 'Please select...') {
        $preg_status    = $_POST['preg_status'];
    } else {
        $preg_status = '02_No';
    }


    if ($_POST['with_allergy'] != 'Do you have allergy?') {
        $with_allergy   = $_POST['with_allergy'];
    } else {
        $with_allergy = '02_No';
    }

    if ($_POST['with_commorbidities'] != 'Do you have comorbidities?') {
        $with_comorbidities = $_POST['with_commorbidities'];
    } else {
        $with_comorbidities = '02_No';
    }
    // $name_allergy   = $_POST['name_allergy'];
    if ($_POST['interact_patient'] != 'Choose here') {
        $direct_covid    = $_POST['interact_patient'];
    } else {
        $direct_covid = '02_No';
    }

    if ($_POST['electronic_consent'] != 'Please select') {
        $consent        = $_POST['electronic_consent'];
    } else {
        $consent        = '03_Unknown';
    }

    if ($_POST['sinovac'] != 'Please select') {
        $sinovac        = $_POST['sinovac'];
    } else {
        $sinovac        = '03_Unknown';
    }


    if ($_POST['astrazeneca'] != 'Please select') {
        $astrazeneca        = $_POST['astrazeneca'];
    } else {
        $astrazeneca        = '03_Unknown';
    }


    //covid history
    if ($_POST['patient_diagnose'] != 'Please select') {
        $patient_diagnose = $_POST['patient_diagnose'];
    } else {
        $patient_diagnose = '02_No';
    }


    if (!empty($_POST['date_positive'])) {
        $date_positive      = date('Y-m-d', strtotime($_POST['date_positive']));
    } else {
        $date_positive     = date('Y-m-d', strtotime('0000-00-00'));
    }

    if ($_POST['name_infection'] != 'Classification of Infection') {
        $name_infection     = $_POST['name_infection'];
    } else {
        $name_infection = 'NONE';
    }

    //classification of allergy
    if ($with_allergy == "02_No") {
        $drug           = "02_No";
        $food           = "02_No";
        $insect         = "02_No";
        $latex          = "02_No";
        $mold           = "02_No";
        $pet            = "02_No";
        $pollen         = "02_No";
        $vaccine        = "02_No";
    } else {
        $drug           = $_POST['allergy_drug'];
        $food           = $_POST['allergy_food'];
        $insect         = $_POST['allergy_insect'];
        $latex          = $_POST['allergy_latex'];
        $mold           = $_POST['allergy_mold'];
        $pet            = $_POST['allergy_pet'];
        $pollen         = $_POST['allergy_pollen'];
        $vaccine        = $_POST['allergy_vaccine'];
    }
    //classification of comorbidity

    if ($with_comorbidities == "02_No") {
        $hypertension   = "02_No";
        $heart          = "02_No";
        $kidney         = "02_No";
        $diabetes       = "02_No";
        $asthma         = "02_No";
        $immuno         = "02_No";
        $cancer         = "02_No";
        $other          = "02_No";
    } else {
        $hypertension   = $_POST['como_hypertension'];
        $heart          = $_POST['como_heart'];
        $kidney         = $_POST['como_kidney'];
        $diabetes       = $_POST['como_diabetes'];
        $asthma         = $_POST['como_asthma'];
        $immuno         = $_POST['como_immunodeficiency'];
        $cancer         = $_POST['como_cancer'];
        $other          = $_POST['como_other'];
    }




    $insert_vaccine_sql = "UPDATE tbl_vaccine SET 
        
            datecreate              = :datereg,
            time_reg                = :time_regg,
            Category                = :categ,
            CategoryID              = :categ_id,
            CategoryIDnumber        = :idnooo,
            HealthWorker            = :healthworker,
            PhilHealthID            = :philhealth,
            PWD_ID                  = :pwd,
            Lastname                = :lastname,
            Firstname               = :firstname,
            Middlename              = :middlename,
            Suffix                  = :suffix,
            Contact_no              = :contacno,
            Full_address            = :fulladdress,
            Region                  = :region,
            Province                = :province,
            MunCity                 = :muncity,
            Barangay                = :brgy,
            Sex                     = :gender,
            Birthdate_              = :birthdate,
            Civilstatus             = :civil,
            Employed                = :emp_stat,
            Direct_covid            = :direct_covid,
            Profession              = :profee,
            Employer_name           = :emp_name,
            Employer_LGU            = :emp_lgu,
            Employer_address        = :emp_add,
            Employer_contact_no    = :emp_contact,
            Preg_status             = :preg_stat,
            W_allergy               = :with_allergy,
            Allergy_01              = :allergy1,
            Allergy_02              = :allergy2,
            Allergy_03              = :allergy3,
            Allergy_04              = :allergy4,
            Allergy_05              = :allergy5,
            Allergy_06              = :allergy6,
            Allergy_07              = :allergy7,
            Allergy_08              = :allergy8,
            W_comorbidities         = :with_comorbodities,
            Comorbidity_01          = :com1,
            Comorbidity_02          = :com2,
            Comorbidity_03          = :com3,
            Comorbidity_04          = :com4,
            Comorbidity_05          = :com5,
            Comorbidity_06          = :com6,
            Comorbidity_07          = :com7,
            Comorbidity_08          = :com8,
            covid_history           = :history,
            covid_date              = :date_history,
            covid_classification    = :infection,
            Consent                 = :consent,
            status                  = 'VALIDATED',
            sinovac                 = :sinovac,
            astrazeneca             = :astrazeneca
            where entity_no         = :entityno
    
        ";

    $vaccine_data = $con->prepare($insert_vaccine_sql);
    $vaccine_data->execute([
        ':entityno'         => $entityno,
        ':datereg'          => $date_reg,
        ':time_regg'        => $time,
        ':categ'            => $category,
        ':categ_id'         => $category_id,
        ':healthworker'     => $healthworker,
        ':idnooo'           => $idnumber,
        ':philhealth'       => $philhealth,
        ':pwd'              => $pwd,
        ':lastname'         => $lastname,
        ':firstname'        => $firstname,
        ':middlename'       => $middlename,
        ':suffix'           => $suffix,
        ':contacno'         => $contactno,
        ':fulladdress'      => $street,
        ':region'           => $region,
        ':province'         => $province,
        ':muncity'          => $city,
        ':brgy'             => $barangay,
        ':gender'           => $gender,
        ':birthdate'        => $birthdate,
        ':civil'            => $civil_stat,
        ':emp_stat'         => $emp_status,
        ':direct_covid'     => $direct_covid,
        ':profee'           => $profession,
        ':emp_name'         => $emp_name,
        ':emp_lgu'          => $emp_lgu,
        ':emp_add'          => $emp_address,
        ':emp_contact'      => $emp_contact,
        ':preg_stat'        => $preg_status,
        ':with_allergy'     => $with_allergy,
        ':allergy1'         => $drug,
        ':allergy2'         => $food,
        ':allergy3'         => $insect,
        ':allergy4'         => $latex,
        ':allergy5'         => $mold,
        ':allergy6'         => $pet,
        ':allergy7'         => $pollen,
        ':allergy8'         => $vaccine,
        ':with_comorbodities'   => $with_comorbidities,
        ':com1'             => $hypertension,
        ':com2'             => $heart,
        ':com3'             => $kidney,
        ':com4'             => $diabetes,
        ':com5'             => $asthma,
        ':com6'             => $immuno,
        ':com7'             => $cancer,
        ':com8'             => $other,
        ':history'          => $patient_diagnose,
        ':date_history'     => $date_positive,
        ':infection'        => $name_infection,
        ':consent'          => $consent,
        ':sinovac'          => $sinovac,
        ':astrazeneca'      => $astrazeneca


    ]);

    $update_individual_sql = "UPDATE tbl_individual SET 
        fullname        = :fullname,
        firstname       = :fname,
        middlename      = :mname,
        lastname        = :lname,
        -- gender          = :gender,
        birthdate       = :bdate
        -- street          = :street,
        -- barangay        = :brgy,
        -- province        = :province,
        -- city            = :city,
        -- mobile_no       = :contact
        where entity_no = :entityNo ";

    $update_individual_data = $con->prepare($update_individual_sql);
    $update_individual_data->execute([
        ':entityNo'     => $entityno,
        ':fullname'     => $firstname . ' ' . $middlename . ' ' . $lastname,
        ':fname'        => $firstname,
        ':mname'        => $middlename,
        ':lname'        => $lastname,
        // ':gender'       => $gender,
        ':bdate'        => $birthdate
        // ':street'       => $street,
        // ':brgy'         => $barangay,
        // ':province'     => $province,
        // ':city'         => $city,
        // ':contact'      => $contactno

    ]);

    $update_individual_sql = "UPDATE tbl_entity SET 
        status          = :status
        
        where entity_no = :entityNo ";

    $update_individual_data = $con->prepare($update_individual_sql);
    $update_individual_data->execute([
        ':entityNo'     => $entityno,
        ':status'       => 'VERIFIED'
    ]);



    if ($vaccine_data && $update_individual_data) {

        $_SESSION['status'] = "Update Successful!";
        $_SESSION['status_code'] = "success";

        header('location: list_vaccine_profile.php');
    } else {
        $_SESSION['status'] = "Update Unsuccessful!";
        $_SESSION['status_code'] = "error";

        header('location: list_vaccine_profile.php');
    }
}
