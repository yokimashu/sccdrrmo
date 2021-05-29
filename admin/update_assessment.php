<?php

include('../config/db_config.php');


session_start();
date_default_timezone_set('Asia/Manila');

$alert_msg = '';

if (isset($_POST['update_assessment'])) {


    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // category
    $objid          = $_POST['objid'];
    $date_reg       = date('Y-m-d', strtotime($_POST['date_reg']));
    $time           = date("H:i:s");

    //basic information
    $entityno        = $_POST['entity_number'];

    //medical conditions

    if ($_POST['electronic_consent'] != 'Please select') {
        $consent        = $_POST['electronic_consent'];
    } else {
        $consent        = '03_Unknown';
    }

    if ($_POST['age_16'] != 'Please select') {
        $age_16              = $_POST['age_16'];
    } else {
        $age_16 = '01_Yes';
    }

    if ($_POST['allergy_PEG'] != 'Please select') {
        $allergy_peg         = $_POST['allergy_PEG'];
    } else {
        $allergy_peg = '01_Yes';
    }
  
    if ($_POST['food_allergy'] != 'Please select') {
        $food_allergy        = $_POST['food_allergy'];
    } else {
        $food_allergy = '01_Yes';
    }
    

    if ($_POST['monitor_patient'] != 'Please select') {
        $monitor_patient     = $_POST['monitor_patient'];
    } else {
        $monitor_patient = '01_Yes';
    }

    if ($_POST['allergic_reaction'] != 'Please select') {
        $allergic_reaction   = $_POST['allergic_reaction'];
 
    } else {
        $allergic_reaction = '01_Yes';
    }

    if ($_POST['covid_exposure'] != 'Please select') {
        $covid_exposure      = $_POST['covid_exposure'];
    } else {
        $covid_exposure = '01_Yes';
    }
  

    if ($_POST['covid_treated'] != 'Please select') {
        $covid_treated       = $_POST['covid_treated'];
    } else {
        $covid_treated = '01_Yes';
    }


    if ($_POST['covid_antibody'] != 'Please select') {
        $covid_antibody      = $_POST['covid_antibody'];
    } else {
        $covid_antibody = '01_Yes';
    }


    if ($_POST['yes_bleeding'] != 'Please select') {
        $yes_bleeding        = $_POST['yes_bleeding'];
    } else {
        $yes_bleeding = '01_Yes';
    }


    if ($_POST['bleeding_history'] != 'Please select') {
        $bleeding_history    = $_POST['bleeding_history'];
    } else {
        $bleeding_history = '01_Yes';
    }

    if ($_POST['no_received_vaccine'] != 'Please select') {
        $no_received_vaccine = $_POST['no_received_vaccine'];
    } else {
        $no_received_vaccine = '01_Yes';
    }



    if ($_POST['medical_clearance'] != 'Please select') {
        $medical_clearance = $_POST['medical_clearance'];
    } else {
        $medical_clearance = '02_No';
    }


    if (!empty($_POST['refusal'])) {
        $refusal = $_POST['refusal'];
        $status = 'REFUSAL';
    } else {
        $refusal = 'N/A';
        $status = 'VACCINATED';
    }

    if ($_POST['preg_semester'] != 'Please select') {
        $preg_semester = $_POST['preg_semester'];
    } else {
        $preg_semester = '02_No';
    }

    if ($_POST['preg_status'] != 'Select pregnancy status...') {
        $preg_status    = $_POST['preg_status'];
    } else {
        $preg_status = '02_No';
    }

    if (!empty($_POST['deferral'])) {
        $deferral = $_POST['deferral'];
        $status = 'DEFERRAL';
    } else {
        $deferral = 'N/A';
        $status = 'VACCINATED';
    }

    if ($_POST['manifest_symptoms'] != 'Please select') {
        $manifest_symptoms = $_POST['manifest_symptoms'];
    } else {
        $manifest_symptoms = '01_Yes';
    }

    if (!empty($_POST['list_symptoms'])) {
        $list_symptoms = $_POST['list_symptoms'];
    } else {
        $list_symptoms = ['N/A'];
    }

    if ($_POST['no_illness'] != 'Please select') {
        $no_illness = $_POST['no_illness'];
    } else {
        $no_illness = '01_Yes';
    }

    if (!empty($_POST['list_illness'])) {
        $list_illness = $_POST['list_illness'];
    } else {
        $list_illness = ['N/A'];
    }


    $vaccination_date    = date('Y-m-d', strtotime($_POST['vaccination_date']));

    if ($_POST['vaccine_manufacturer'] != '') {
        $manufacturer = $_POST['vaccine_manufacturer'];
    } else {
        $manufacturer = 'N/A';
    }
   
    if (!empty($_POST['batch_number'])) {
        $batch_number        = $_POST['batch_number'];
    } else {
        $batch_number = 'N/A';
    }
   
    if (!empty($_POST['lot_number'])) {
        $lot_number          = $_POST['lot_number'];
    } else {
        $lot_number = 'N/A';
    }
  
    if ($_POST['vaccinator'] != '') {
        $vaccinator = $_POST['vaccinator'];
    } else {
        $vaccinator = 'N/A';
    }

    if (!empty($_POST['profession_vaccinator'])) {
        $profession          = $_POST['profession_vaccinator'];
    } else {
        $profession = 'N/A';
    }
   
    if ($_POST['first_dose'] != 'Please select') {
        $first_dose = $_POST['first_dose'];
    } else {
        $first_dose = '02_No';
    }

    if ($_POST['second_dose'] != 'Please select') {
        $second_dose = $_POST['second_dose'];
    } else {
        $second_dose = '02_No';
    }
   
    $insert_assessment_sql = "UPDATE tbl_assessment SET 
        
            date_reg                = :date_reg,
            time_reg                = :time_reg,
            consent                 = :consent,
            Refusal_Reasons         = :refusal_reasons,
            MoreThan16yo            = :age_16,
            PegPolysorbate          = :peg_polysorbate,
            Severe_Reaction         = :severe_reaction,
            AllergyToFood           = :allergy_food,
            MonitorAllergy          = :monitor_allergy,
            BleedingDisorders       = :bleeding_disorder,
            BleedingHistory         = :bleeding_history,
            ManifestSymptoms        = :manifest_symptoms,
            MentionedSymptoms       = :mentioned_symptoms,
            CovidHistory            = :covid_history,
            CovidTreated            = :covid_treated,
            ReceivedVaccine         = :received_vaccine,
            AntibodiesCovid         = :antibodies_covid,
            Pregnant                = :pregnant,
            PregnantSemester        = :pregnant_semester,
            Illness                 = :illness,
            MentionedIllness        = :mentioned_illness,
            MedicalClearance        = :medical_clearance,
            Deferral                = :deferral,
            DateVaccination         = :date_vaccination,
            VaccineManufacturer     = :manufacturer,
            BatchNumber             = :batch_number,
            LotNumber               = :lot_number,
            VaccinatorName          = :vaccinator,
            VaccinatorProfession    = :vaccinator_profession,
            1stDose                 = :first_dose,
            2ndDose                 = :second_dose,
            status                  = :status
            where entity_no         = :entityno
            and objid               = :objid
    
        ";

    $assessment_data = $con->prepare($insert_assessment_sql);
    $assessment_data->execute([
        ':entityno'                     => $entityno,
        ':objid'                        => $objid,
        ':date_reg'                     => $date_reg,
        ':time_reg'                     => $time,
        ':consent'                      => $consent,
        ':refusal_reasons'              => $refusal,
        ':age_16'                       => $age_16,
        ':peg_polysorbate'              => $allergy_peg,
        ':severe_reaction'              => $allergic_reaction,
        ':allergy_food'                 => $food_allergy,
        ':monitor_allergy'              => $monitor_patient,
        ':bleeding_disorder'            => $bleeding_history,
        ':bleeding_history'             => $yes_bleeding,
        ':manifest_symptoms'            => $manifest_symptoms,
        ':mentioned_symptoms'           => implode(", ", $list_symptoms),
        ':covid_history'                => $covid_exposure,
        ':covid_treated'                => $covid_treated,
        ':received_vaccine'             => $no_received_vaccine,
        ':antibodies_covid'             => $covid_antibody,
        ':pregnant'                     => $preg_status,
        ':pregnant_semester'            => $preg_semester,
        ':illness'                      => $no_illness,
        ':mentioned_illness'            => implode(", ", $list_illness),
        ':medical_clearance'            => $medical_clearance,
        ':deferral'                     => $deferral,
        ':date_vaccination'             => $vaccination_date,
        ':manufacturer'                 => $manufacturer,
        ':batch_number'                 => $batch_number,
        ':lot_number'                   => $lot_number,
        ':vaccinator'                   => $vaccinator,
        ':vaccinator_profession'        => $profession,
        ':first_dose'                   => $first_dose,
        ':second_dose'                  => $second_dose,
        ':status'                       => $status


    ]);




    if ($assessment_data) {

        $_SESSION['status'] = "Update Successful!";
        $_SESSION['status_code'] = "success";

        header('location: add_assessment.php?id=' . $objid);
    } else {
        $_SESSION['status'] = "Update Unsuccessful!";
        $_SESSION['status_code'] = "error";

        header('location: add_assessment.php?id=' . $objid);
    }
}
