<?php

include('../config/db_config.php');


session_start();
date_default_timezone_set('Asia/Manila');

$alert_msg = '';

$activity = "VACCINE FORM REGISTRATION";

$user_name = strtoupper($_POST['encoder_fullname']);

if (isset($_POST['insert_vaccine'])) {




    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // category
    // $date_reg       = date('Y-m-d', strtotime($_POST['date_register']));
    // $time           = date("h:i:s a");
    // $category       = $_POST['category'];
    // $category_id    = $_POST['category_id'];
    // $healthworker   = $_POST['health_worker'];
    // $idnumber       = $_POST['idno'];
    // $philhealth     = $_POST['philhealth_id'];
    // $pwd            = $_POST['pwd_id'];

    // //basic information
    // $entityno        = $_POST['entity_number'];
    // $lastname       = $_POST['lastname'];
    // $firstname      = $_POST['firstname'];
    // $middlename     = $_POST['middlename'];
    // $suffix         = $_POST['suffix'];
    // $gender         = $_POST['gender'];
    // //for gender
    // // if ($_POST['gender'] == 'female') {
    // //     $gender     = "01_Female";
    // // } elseif ($_POST['gender'] == 'male') {
    // //     $gender     = "02_Male";
    // // } else {
    // //     $gender     = "03_Not to disclose";
    // // }


    // $birthdate      = date('Y-m-d', strtotime($_POST['birthdate']));
    // $civil_stat      = $_POST['civil_status'];
    // $contactno      = $_POST['contact_no'];
    // $emp_status     = $_POST['emp_status'];
    // $profession     = $_POST['profession'];

    // //full address
    // $region         = "WesternVisayas";
    // $province       = "_0645_NEGROS_OCCIDENTAL";
    // $city           = "_64524_SAN_CARLOS_CITY";
    // $barangay       = strtoupper($_POST['barangay']);

    // //for bararangay 
    // if ($barangay == 'BARANGAY I') {
    //     $barangay1 = "_64524010_BARANGAY_I_(POB.)";
    // } elseif ($barangay == 'BARANGAY II') {
    //     $barangay1 = "_64524011_BARANGAY_II_(POB.)";
    // } elseif ($barangay == 'BARANGAY III') {
    //     $barangay1 = "_64524012_BARANGAY_III_(POB.)";
    // } elseif ($barangay == 'BARANGAY IV') {
    //     $barangay1 = "_64524013_BARANGAY_IV_(POB.)";
    // } elseif ($barangay == 'BARANGAY V') {
    //     $barangay1 = "_64524014_BARANGAY_V_(POB.)";
    // } elseif ($barangay == 'BARANGAY VI') {
    //     $barangay1 = "_64524015_BARANGAY_VI_(POB.)";
    // } elseif ($barangay == 'BAGONBON') {
    //     $barangay1 = "_64524001_BAGONBON";
    // } elseif ($barangay == 'BULUANGAN') {
    //     $barangay1 = "_64524002_BULUANGAN";
    // } elseif ($barangay == 'CODCOD') {
    //     $barangay1 = "_64524004_CODCOD";
    // } elseif ($barangay == 'ERMITA') {
    //     $barangay1 = "_64524005_ERMITA";
    // } elseif ($barangay == 'GUADALUPE') {
    //     $barangay1 = "_64524006_GUADALUPE";
    // } elseif ($barangay == 'NATABAN') {
    //     $barangay1 = "_64524008_NATABAN";
    // } elseif ($barangay == 'PALAMPAS') {
    //     $barangay1 = "_64524009_PALAMPAS";
    // } elseif ($barangay == 'PROSPERIDAD') {
    //     $barangay1 = "_64524016_PROSPERIDAD";
    // } elseif ($barangay == 'PUNAO') {
    //     $barangay1 = "_64524017_PUNAO";
    // } elseif ($barangay == 'QUEZON') {
    //     $barangay1 = "_64524018_QUEZON";
    // } elseif ($barangay == 'RIZAL') {
    //     $barangay1 = "_64524019_RIZAL";
    // } elseif ($barangay == 'SAN JUAN') {
    //     $barangay1 = "_64524020_SAN_JUAN";
    // }

    // $street         = $_POST['street'];
    // $fulladdress    = $street . ', ' . $barangay;
    // //employer
    // $emp_name       = $_POST['name_employeer'];
    // $emp_contact    = $_POST['emp_contact'];
    // $emp_address    = $_POST['emp_address'];
    // $emp_lgu        = "_64524_SAN_CARLOS_CITY";

    // //medical conditions
    // $preg_status    = $_POST['preg_status'];
    // $with_allergy   = $_POST['with_allergy'];
    // $with_comorbidities = $_POST['with_commorbidities'];
    // // $name_allergy   = $_POST['name_allergy'];
    // $direct_covid    = $_POST['interact_patient'];
    // $consent        = $_POST['electronic_consent'];

    // //covid history
    // $patient_diagnose = $_POST['patient_diagnose'];
    // if (!empty($_POST['date_positive'])) {
    //     $date_positive      = date('Y-m-d', strtotime($_POST['date_positive']));
    // } else {
    //     $date_positive     = date('Y-m-d', strtotime('0000-00-00'));
    // }

    // if (!empty($_POST['name_infection'])) {
    //     $name_infection     = $_POST['name_infection'];
    // } else {
    //     $name_infection = 'NONE';
    // }

    // //classification of allergy
    // $drug           = $_POST['allergy_drug'];
    // $food           = $_POST['allergy_food'];
    // $insect         = $_POST['allergy_insect'];
    // $latex          = $_POST['allergy_latex'];
    // $mold           = $_POST['allergy_mold'];
    // $pet            = $_POST['allergy_pet'];
    // $pollen         = $_POST['allergy_pollen'];
    // $vaccine        = $_POST['allergy_vaccine'];

    // //classification of comorbidity
    // $hypertension   = $_POST['como_hypertension'];
    // $heart          = $_POST['como_heart'];
    // $kidney         = $_POST['como_kidney'];
    // $diabetes       = $_POST['como_diabetes'];
    // $asthma         = $_POST['como_asthma'];
    // $immuno         = $_POST['como_immunodeficiency'];
    // $cancer         = $_POST['como_cancer'];
    // $other          = $_POST['como_other'];


    // category
    $date_reg       = date('Y-m-d', strtotime($_POST['date_register']));
    $time           = date("h:i:s a");
    $category       = $_POST['category'];
    $category_id    = $_POST['category_id'];
    $healthworker   = $_POST['health_worker'];
    $subpriority    = $_POST['subprio'];
    $indigentss       = $_POST['indigent'];
    $frontline_subprio  = $_POST['frontline_subpriority'];




    if ($_POST['idno'] != '') {
        $idnumber = $_POST['idno'];
    } else {
        $idnumber = 'N/A';
    }

    if ($_POST['philhealth_id'] != '') {
        $philhealth = $_POST['philhealth_id'];
    } else {
        $philhealth = 'N/A';
    }

    if ($_POST['pwd_id'] != '') {
        $pwd = $_POST['pwd_id'];
    } else {
        $pwd = 'N/A';
    }


    //basic information
    $entityno        = $_POST['entity_no'];
    $lastname       = strtoupper($_POST['lastname']);
    $firstname      = strtoupper($_POST['firstname']);
    $middlename     = strtoupper($_POST['middlename']);
    $suffix         = strtoupper($_POST['suffix']);
    $fullname       = strtoupper($_POST['firstname'] . ' ' . $_POST['middlename'] . ' ' . $_POST['lastname']);
    $age            = $_POST['agess'];
    $guardianname   = strtoupper($_POST['guardian_name']);
    $guardianrelation   = strtoupper($_POST['guardian_relation']);

    $gender         = $_POST['gender'];

    //for gender
    if ($_POST['gender'] == '01_Female') {
        $gender1     = "Female";
    } elseif ($_POST['gender'] == '02_Male') {
        $gender1     = "Male";
    } else {
        $gender1     = "03_Not to disclose";
    }


    $birthdate      = date('Y-m-d', strtotime($_POST['birthdate']));
    $civil_stat     = $_POST['civil_status'];
    $contactno      = $_POST['contact_no'];
    $emp_status     = $_POST['emp_status'];
    $department     = $_POST['department'];
    $profession     = $_POST['profession'];

    if ($_POST['indicate_profession'] != '') {
        $indicate = $_POST['indicate_profession'];
    } else {
        $indicate = 'N/A';
    }


    $tracer_fullname = strtoupper($_POST['encoder_fullname']);

    //full address
    $region         = "WesternVisayas";
    $province       = "_0645_NEGROS_OCCIDENTAL";
    $city           = "_64524_SAN_CARLOS_CITY";
    $barangay       = strtoupper($_POST['barangay']);
    $sinovac        = $_POST['sinovac'];
    $astrazeneca    = $_POST['astrazeneca'];
    $pfizer         = $_POST['pfizer'];
    $janssen        = $_POST['janssen'];
    $moderna        = $_POST['moderna'];

    //for bararangay 
    if ($barangay == 'BARANGAY I') {
        $barangay1 = "_64524010_BARANGAY_I_(POB.)";
    } elseif ($barangay == 'BARANGAY II') {
        $barangay1 = "_64524011_BARANGAY_II_(POB.)";
    } elseif ($barangay == 'BARANGAY III') {
        $barangay1 = "_64524012_BARANGAY_III_(POB.)";
    } elseif ($barangay == 'BARANGAY IV') {
        $barangay1 = "_64524013_BARANGAY_IV_(POB.)";
    } elseif ($barangay == 'BARANGAY V') {
        $barangay1 = "_64524014_BARANGAY_V_(POB.)";
    } elseif ($barangay == 'BARANGAY VI') {
        $barangay1 = "_64524015_BARANGAY_VI_(POB.)";
    } elseif ($barangay == 'BAGONBON') {
        $barangay1 = "_64524001_BAGONBON";
    } elseif ($barangay == 'BULUANGAN') {
        $barangay1 = "_64524002_BULUANGAN";
    } elseif ($barangay == 'CODCOD') {
        $barangay1 = "_64524004_CODCOD";
    } elseif ($barangay == 'ERMITA') {
        $barangay1 = "_64524005_ERMITA";
    } elseif ($barangay == 'GUADALUPE') {
        $barangay1 = "_64524006_GUADALUPE";
    } elseif ($barangay == 'NATABAN') {
        $barangay1 = "_64524008_NATABAN";
    } elseif ($barangay == 'PALAMPAS') {
        $barangay1 = "_64524009_PALAMPAS";
    } elseif ($barangay == 'PROSPERIDAD') {
        $barangay1 = "_64524016_PROSPERIDAD";
    } elseif ($barangay == 'PUNAO') {
        $barangay1 = "_64524017_PUNAO";
    } elseif ($barangay == 'QUEZON') {
        $barangay1 = "_64524018_QUEZON";
    } elseif ($barangay == 'RIZAL') {
        $barangay1 = "_64524019_RIZAL";
    } elseif ($barangay == 'SAN JUAN') {
        $barangay1 = "_64524020_SAN_JUAN";
    }

    $street         = $_POST['street'];
    $fulladdress    = strtoupper($street . ', ' . $barangay);
    //employer

    if ($_POST['name_employeer'] != '') {
        $emp_name       = strtoupper($_POST['name_employeer']);
    } else {
        $emp_name = 'N/A';
    }

    if ($_POST['emp_contact'] != '') {
        $emp_contact    = $_POST['emp_contact'];
    } else {
        $emp_contact = 'N/A';
    }

    if ($_POST['emp_address'] != '') {
        $emp_address    = strtoupper($_POST['emp_address']);
    } else {
        $emp_address = 'N/A';
    }

    $emp_lgu        = "_64524_SAN_CARLOS_CITY";

    //medical conditions
    if ($_POST['preg_status'] != 'Select pregnancy status...') {
        $preg_status    = $_POST['preg_status'];
    } else {
        $preg_status = '02_Not_Pregnant';
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
        $hypertension       = "02_No";
        $chronic_kindey     = "02_No";
        $heart              = "02_No";
        $cerebrovascular    = "02_No";
        $kidney             = "02_No";
        $neurologic         = "02_No";
        $diabetes           = "02_No";
        $liver              = "02_No";
        $asthma             = "02_No";
        $tract_infection    = "02_No";
        $immuno             = "02_No";
        $obesity            = "02_No";
        $cancer             = "02_No";
        $tuberculosis       = "02_No";
        $respiratory        = "02_No";
        $malignancy         = "02_No";
        $cardiovascular     = "02_No";
        $other              = "02_No";
    } else {
        $hypertension       = $_POST['como_hypertension'];
        $chronic_kindey     = $_POST['como_chronic_kindey'];
        $heart              = $_POST['como_heart'];
        $cerebrovascular    = $_POST['como_cerebrovascular'];
        $kidney             = $_POST['como_kidney'];
        $neurologic         = $_POST['como_neurologic'];
        $diabetes           = $_POST['como_diabetes'];
        $liver              = $_POST['como_liver'];
        $asthma             = $_POST['como_asthma'];
        $tract_infection    = $_POST['como_tract_infection'];
        $immuno             = $_POST['como_immunodeficiency'];
        $obesity            = $_POST['como_obesity'];
        $cancer             = $_POST['como_cancer'];
        $tuberculosis       = $_POST['como_tuberculosis'];
        $respiratory        = $_POST['como_respiratory'];
        $malignancy         = $_POST['como_malignancy'];
        $cardiovascular     = $_POST['como_cardiovascular'];
        $other              = $_POST['como_other'];
    }



    $insert_vaccine_sql = "INSERT INTO tbl_vaccine SET 
            entity_no               = :entityno,
            datecreate              = :datereg,
            time_reg                = :time_regg,
            Category                = :categ,
            CategoryID              = :categ_id,
            CategoryIDnumber        = :idnooo,
            PhilHealthID            = :philhealth,
            SubPriority             = :subprio,
            FrontlineSubPriority    = :frontline_subprio,
            HealthWorker            = :healthworker,
            Indigent                = :indigents,
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
            indicate                = :indicate,
            Employer_name           = :emp_name,
            Department              = :dept,
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
            Comorbidity_09          = :com9,
            Comorbidity_10          = :com10,
            Comorbidity_11          = :com11,
            Comorbidity_12          = :com12,
            Comorbidity_13          = :com13,
            Comorbidity_14          = :com14,
            Comorbidity_15          = :com15,
            Comorbidity_16          = :com16,
            Comorbidity_17          = :com17,
            Comorbidity_18          = :com18,
            covid_history           = :history,
            covid_date              = :date_history,
            covid_classification    = :infection,
            Consent                 = :consent,
            sinovac                 = :sinovacs,
            astrazeneca             = :astravas,
            username                = :user,
            pfizer                  = :pfizer,
            johnsons                = :johnsons,
            moderna                 = :moderna,
            guardian_name           = :guardian,
            guardian_relation       = :relation,
            status                  = :statuss
        ";

    $vaccine_data = $con->prepare($insert_vaccine_sql);
    $vaccine_data->execute([
        ':entityno'         => $entityno,
        ':datereg'          => $date_reg,
        ':time_regg'        => $time,
        ':categ'            => $category,
        ':categ_id'         => $category_id,
        ':idnooo'           => $idnumber,
        ':healthworker'     => $healthworker,
        ':subprio'          => $subpriority,
        ':frontline_subprio' => $frontline_subprio,
        ':indigents'        => $indigentss,
        ':philhealth'       => $philhealth,
        ':pwd'              => $pwd,
        ':lastname'         => $lastname,
        ':firstname'        => $firstname,
        ':middlename'       => $middlename,
        ':suffix'           => $suffix,
        ':contacno'         => $contactno,
        ':fulladdress'      => $fulladdress,
        ':region'           => $region,
        ':province'         => $province,
        ':muncity'          => $city,
        ':brgy'             => $barangay1,
        ':gender'           => $gender,
        ':birthdate'        => $birthdate,
        ':civil'            => $civil_stat,
        ':emp_stat'         => $emp_status,
        ':direct_covid'     => $direct_covid,
        ':profee'           => $profession,
        ':indicate'         => $indicate,
        ':emp_name'         => $emp_name,
        ':dept'             => $department,
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
        ':com9'             => $respiratory,
        ':com10'            => $cardiovascular,
        ':com11'            => $chronic_kindey,
        ':com12'            => $cerebrovascular,
        ':com13'            => $neurologic,
        ':com14'            => $liver,
        ':com15'            => $tract_infection,
        ':com16'            => $obesity,
        ':com17'            => $tuberculosis,
        ':com18'            => $malignancy,
        ':history'          => $patient_diagnose,
        ':date_history'     => $date_positive,
        ':infection'        => $name_infection,
        ':consent'          => $consent,
        ':sinovacs'         => $sinovac,
        ':astravas'         => $astrazeneca,
        ':pfizer'           => $pfizer,
        ':johnsons'         => $janssen,
        ':moderna'          => $moderna,
        ':user'             => $tracer_fullname,
        ':relation'         => $guardianrelation,
        ':guardian'         => $guardianname,
        ':statuss'          => 'NEW'


    ]);

    $get_data_sql = "SELECT * FROM  tbl_individual where entity_no = :id";
    $get_data_data = $con->prepare($get_data_sql);
    $get_data_data->execute([':id' => $entityno]);
    if ($get_data_data->rowCount() > 0) {

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

        $update_entityno_sql = "UPDATE tbl_entity SET 
                status          = :status
                
                where entity_no = :entityNo ";

        $update_entityno_data = $con->prepare($update_entityno_sql);
        $update_entityno_data->execute([
            ':entityNo'     => $entityno,
            ':status'       => 'VERIFIED'
        ]);
    } else {

        $alert_msg = ' ';
        //insert to tbl_individual

        //$user_name = $_POST['lastname'] . ' ' . $_POST['birthdate'];
        $hashed_password  = password_hash($entityno, PASSWORD_DEFAULT);
        $type = 'INDIVIDUAL';
        $status = 'VERIFIED';
        $fileName = 'default.jpg';

        //upload image

        $insert_individual_sql = "INSERT INTO tbl_individual SET 
        
            entity_no        = :entity_no,
            date_register    = :date_register,
            firstname        = :firstname,
            middlename       = :middlename,
            lastname         = :lastname,
            fullname         = :fullname,
            mobile_no        = :mobile_no,
            telephone_no     = '-',
            email            = '-',
            gender           = :gender,
            birthdate        = :birthdate,
            age              = :ageq,
            street           = :street,
            barangay         = :barangay,
            city             = :city,
            province         = :province,  
            photo            = :photo
        
        ";

        $individual_data = $con->prepare($insert_individual_sql);
        $individual_data->execute([
            ':entity_no'         => $entityno,
            ':date_register'     => $date_reg,
            ':firstname'         => $firstname,
            ':middlename'        => $middlename,
            ':lastname'          => $lastname,
            ':fullname'          => $fullname,
            ':ageq'              => $age,
            ':gender'            => $gender1,
            ':mobile_no'         => $contactno,
            ':barangay'          => $barangay,
            ':birthdate'         => $birthdate,
            ':street'            => $street,
            ':city'              => 'SAN CARLOS CITY',
            ':province'          => 'NEGROS OCCIDENTAL',
            ':photo'             => $fileName

        ]);



        //INSERT ENTITY TABLE

        $insert_entity_sql = "INSERT INTO tbl_entity SET 
            entity_no           = :entity_no,
            username            = :username,
            password            = :password,
            type                = :type,
            status              = :status";


        $insert_entity_data = $con->prepare($insert_entity_sql);
        $insert_entity_data->execute([

            ':entity_no'        => $entityno,
            ':username'         => $entityno,
            ':password'         => $hashed_password,
            ':type'             => 'INDIVIDUAL',
            ':status'           => 'VERIFIED'

        ]);
    }

    $timenow = date('H:i:s');
    $title = 'COVID-19 MASTERLISTING';
    $message = "Good day! Your vaccination record has been successfully added to our masterlist. You may check and edit your response anytime as long as your vaccination schedule is not yet finalized. Just follow these steps:
    \r\n\r\n 1. Open web browser (Google Chrome, Safari, Firefox, Microsoft Edge) in your computer or mobile phones/tablets.
    \r\n\r\n 2. Type https://vamosmobile.app/vaccine in the address bar.
    \r\n\r\n 3. Enter your VAMOS ID (entity no) then check the 'I am not a robot' and press the -> button. A 6-digit verification code will be sent to your registered phone number.
    \r\n\r\n 4. Enter the 6-digit verification code and press the -> button.
    \r\n\r\n 5. Once verified, your VAMOS profile will be displayed, check and validate your VACCINATION record.
    \r\n\r\n 6. Click the SUBMIT FORM button once done.
    \r\n\r\n NOTE: You may also print your VACCINATION FORM in advance to avoid long queues in the registration during the vaccinaton day.
    \r\n\r\n We will notify you here once your schedule and vaccination site are already assigned. Thank you and keep safe!";

    $insert_notif_sql = "INSERT INTO tbl_notification SET 

            entity_no           = :entity_no,
            message             = :message,
            date                = now(),
            time                = :time,
            title               = :title,
            status              = 'UNREAD'";

    $notif_data = $con->prepare($insert_notif_sql);
    $notif_data->execute([

        ':entity_no'         => $entityno,
        ':message'           => $message,
        ':time'              => $timenow,
        ':title'             => $title


    ]);

    include('update_logs.php');

    if ($vaccine_data && $get_data_data) {

        $_SESSION['status'] = "Registered Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_vaccine_profile.php');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: list_vaccine_profile.php');
    }
}
