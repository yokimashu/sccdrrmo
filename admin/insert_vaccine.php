<?php

include('../config/db_config.php');


session_start();
date_default_timezone_set('Asia/Manila');
$alert_msg = '';

if (isset($_POST['insert_vaccine'])) {


    // individual must updated
    $lastname       = $_POST['lastname'];
    $firstname      = $_POST['firstname'];
    $middlename     = $_POST['middlename'];
    $gender         = $_POST['gender'];
    $birthdate      = date('Y-m-d', strtotime($_POST['birthdate']));
    $suffix         = $_POST['suffix'];
    $contactno      = $_POST['contact_no'];
    $street         = $_POST['street'];
    $barangay       = $_POST['barangay'];
    $city           = $_POST['city'];
    $province       = $_POST['province'];

    // vaccine profile
    $date_reg       = date('Y-m-d', strtotime($_POST['date_register']));
    $time           = $_POST['time'];
    $category       = $_POST['category'];
    $category_id     = $_POST['category_id'];

    $idnumber       = $_POST['idno'];
    $entityno        = $_POST['entity_number'];
    $philhealth      = $_POST['philhealth_id'];
    $civil_stat      = $_POST['civil_status'];

    $emp_status     = $_POST['emp_status'];
    $profession     = $_POST['profession'];
    $name_emp       = $_POST['name_employeer'];
    $emp_contact     = $_POST['emp_contact'];
    $emp_address    = $_POST['emp_address'];


    $preg_status    = $_POST['preg_status'];
    $with_allergy   = $_POST['with_allergy'];
    $name_allergy   = $_POST['name_allergy'];
    $with_comorbidities = $_POST['with_commorbidities'];

    if (empty($_POST['name_comorbidities'])) {
        $name_comorbidities = '';
    } else {
        $name_comorbidities =  implode(",", $_POST['name_comorbidities']);
    }

    $patient_diagnose   = $_POST['patient_diagnose'];
    $date_positive      = date('Y-m-d', strtotime($_POST['date_positive']));
    $name_infection     = $_POST['name_infection'];
    $consentation        = $_POST['consentation'];


    $insert_vaccine_sql = "INSERT INTO tbl_vaccine_profile SET 
            entity_no    = :entityno,
            datecreate   = :datereg,
            time_reg     = :time_regg,
            Category     = :categ,
            CategoryID   = :categ_id,
            IDNumber     = :idnooo,
            PhilHealthID = :philhealth,
            Civil_status = :civil,
            Suffix       = :suffix,

            Employed     = :emp_stat,
            Profession   = :profee,
            Employer_name = :emp_name,
            Employer_address =:emp_add,
            Employer_contact_no =:emp_contact,
            
            Preg_status     = :preg_stat,
            W_allergy       = :with_allergy,
            Allergy         = :allergyyy,
            W_comorbidities = :with_comorbodities,
            comorbidity     = :comorbodityyy,
            covid_history   = :history,
            covid_date      = :date_history,
            covid_classification    = :infection,
            consent         = :consents


        ";
    $vaccine_data = $con->prepare($insert_vaccine_sql);
    $vaccine_data->execute([
        ':entityno'         => $entityno,
        ':datereg'          => $date_reg,
        ':time_regg'        => $time,
        ':categ'            => $category,
        ':categ_id'         => $category_id,
        ':idnooo'           => $idnumber,
        ':philhealth'       => $philhealth,
        ':civil'            => $civil_stat,
        ':suffix'           => $suffix,

        ':emp_stat'     => $emp_status,
        ':profee'       => $profession,
        ':emp_name'     => $name_emp,
        ':emp_add'      => $emp_address,
        ':emp_contact'  => $emp_contact,
        ':preg_stat'    => $preg_status,
        ':with_allergy' => $with_allergy,
        ':allergyyy'    => $name_allergy,
        ':with_comorbodities'   => $with_comorbidities,
        ':comorbodityyy'    => $name_comorbidities,
        ':history'      => $patient_diagnose,
        ':date_history' => $date_positive,
        ':infection'    => $name_infection,
        ':consents'     => $consentation

    ]);

    $update_individual_sql = "UPDATE tbl_individual SET 
        fullname        = :fullname,
        firstname       = :fname,
        middlename      = :mname,
        lastname        = :lname,
        gender          = :gender,
        birthdate       = :bdate,
        street          = :street,
        barangay        = :brgy,
        province        = :province,
        city            = :city,
        mobile_no       = :contact
        where entity_no = :entityNo ";

    $update_individual_data = $con->prepare($update_individual_sql);
    $update_individual_data->execute([
        ':entityNo'     => $entityno,
        ':fullname'     => $firstname . ' ' . $middlename . ' ' . $lastname,
        ':fname'        => $firstname,
        ':mname'        => $middlename,
        ':lname'        => $lastname,
        ':gender'       => $gender,
        ':bdate'        => $birthdate,
        ':street'       => $street,
        ':brgy'         => $barangay,
        ':province'     => $province,
        ':city'         => $city,
        ':contact'      => $contactno

    ]);



    if ($vaccine_data && $update_individual_data) {

        $_SESSION['status'] = "Registered Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: add_vaccine_registry.php');
    } else {
        $_SESSION['status'] = "Not successfully registered!";
        $_SESSION['status_code'] = "error";

        header('location: add_vaccine_registry.php');
    }
}
