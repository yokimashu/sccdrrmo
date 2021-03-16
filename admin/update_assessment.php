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
    $date_reg       = date('Y-m-d', strtotime($_POST['date_reg']));
    $time           = date("h:i:s a");

    //basic information
    $entityno        = $_POST['entity_number'];
    
    //medical conditions

    if ($_POST['preg_status'] != 'Select pregnancy status...') {
        $preg_status    = $_POST['preg_status'];
    } else {
        $preg_status = '02_Not_Pregnant';
    }

    if ($_POST['electronic_consent'] != 'Please select') {
        $consent        = $_POST['electronic_consent'];
    } else {
        $consent        = '03_Unknown';
    }

    if($_POST['refusal'] != 'Choose here'){
        $refusal = $_POST['refusal'];
    } else {
        $refusal = 'N/A';
    }

    if($_POST['preg_semester'] != 'Please select...'){
        $preg_semester = $_POST['preg_semester'];
    } else {
        $preg_semester = '02_No';
    }

    if($_POST['deferral'] != 'Choose here'){
        $deferral = $_POST['deferral'];
    } else {
        $deferral = 'N/A';
    }

    if($_POST['list_symptoms[]'] != ''){
        $list_symptoms = $_POST['list_symptoms[]'];
    } else {
        $list_symptoms = 'N/A';
    }

    if($_POST['list_illness[]'] != ''){
        $list_illness = $_POST['list_illness[]'];
    } else {
        $list_illness = 'N/A';
    }



    //////////
    $allergy_peg         = $_POST['allergy_PEG'];
    $food_allergy        = $_POST['food_allergy'];
    $monitor_patient     = $_POST['monitor_patient'];
    $allergic_reaction   = $_POST['allergic_reaction'];
    $covid_exposure      = $_POST['covid_exposure'];
    $covid_treated       = $_POST['covid_treated'];
    $covid_antibody      = $_POST['covid_antibody'];
    $age_16              = $_POST['age_16'];
    $bleeding_history    = $_POST['bleeding_history'];
    $yes_bleeding        = $_POST['yes_bleeding'];
    $no_received_vaccine = $_POST['no_received_vaccine'];
    $manifest_symptoms   = $_POST['manifest_symptoms'];
    $no_illness          = $_POST['no_illness'];
    $medical_clearance   = $_POST['medical_clearance'];
    $vaccination_date    = $_POST['vaccination_date'];
    $manufacturer        = $_POST['vaccine_manufacturer'];
    $batch_number        = $_POST['batch_number'];
    $lot_number          = $_POST['lot_number'];
    $vaccinator          = $_POST['vaccinator'];
    $profession          = $_POST['profession_vaccinator'];
    $first_dose          = $_POST['first_dose'];
    $second_dose          = $_POST['second_dose'];

    $insert_assessment_sql = "UPDATE tbl_assessment SET 
        
            date_reg                = :date_reg,
            time_reg                = :time_reg,
            Refusal_Reasons         = :refusal_reasons,
            MoreThan16yo            = :age_16,
            PegPolysorbate          = :peg_polysorbate,
            SevereReaction          = :severe_reaction,
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
            2ndDose                 = :second_dose

            where entity_no         = :entityno;
    
        ";

    $assessment_data = $con->prepare($insert_assessment_sql);
    $assessment_data->execute([
        ':entityno'                     => $entityno,
        ':datereg'                      => $date_reg,
        ':time_regg'                    => $time,
        ':refusal_reasons'              => $refusal,
        ':age_16'                       => $age_16,
        ':peg_polysorbate'              => $allergy_peg,
        ':severe_reaction'              => $allergic_reaction,
        ':allergy_food'                 => $food_allergy,
        ':monitor_allergy'              => $monitor_patient,
        ':bleeding_disorder'            => $bleeding_history,
        ':bleeding_history'             => $yes_bleeding,
        ':manifest_symptoms'            => $manifest_symptoms,
        ':mentioned_symptoms'           => $list_symptoms,
        ':covid_history'                => $covid_exposure,
        ':covid_treated'                => $covid_treated,
        ':received_vaccine'             => $no_received_vaccine,
        ':antibodies_covid'             => $covid_antibody,
        ':pregnant'                     => $preg_status,
        ':pregnant_semester'            => $preg_semester,
        ':illness'                      => $no_illness,
        ':mentioned_illness'            => $list_illness,
        ':medical_clearance'            => $medical_clearance,
        ':deferral'                     => $deferral,
        ':date_vaccination'             => $vaccination_date,
        ':manufacturer'                 => $manufacturer,
        ':batch_number'                 => $batch_number,
        ':lot_number'                   => $lot_number,
        ':vaccinator'                   => $vaccinator,
        ':vaccinator_profession'        => $profession,
        ':first_dose'                   => $first_dose,
        ':second_dose'                  => $second_dose


    ]);




    // if ($assessment_data) {

    //     $_SESSION['status'] = "Update Successful!";
    //     $_SESSION['status_code'] = "success";

    //     header('location: list_vaccine_profile.php');
    // } else {
    //     $_SESSION['status'] = "Update Unsuccessful!";
    //     $_SESSION['status_code'] = "error";

    //     header('location: list_vaccine_profile.php');
    // }
}

?>
