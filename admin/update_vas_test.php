<?php


session_start();

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
// $cbcr = $_SESSION['cbcr'];


// $bc_name = $bc_code = ' ';




// $get_cbcr_sql = "SELECT * FROM tbl_bakuna_center where bc_code = :cbcr";
// $cbcr_data = $con->prepare($get_cbcr_sql);
// $cbcr_data->execute([':cbcr' => $cbcr]);
// while ($result = $cbcr_data->fetch(PDO::FETCH_ASSOC)) {

//     $bc_code = $result['bc_code'];
//     $bc_name = $result['bc_name'];
// }

// $vas = $_POST['entity_no'];

// $check_vas_sql = "SELECT * FROM tbl_assessment where entity_no = :entity_no and
//                   1stDose = '01_Yes' and 2ndDose = '01_Yes'";

// $check_vas_data = $con->prepare($check_vas_sql);
// $check_vas_data ->execute([
//   ':entity_no' => $vas
// ]);


if (isset($_POST['update_vas_test'])) {


    $entity_no             = $_POST['entity_no'];
    $remarks               = $_POST['remarks'];
    $date_reg      = date('Y-m-d', strtotime($_POST['date_registered']));
    $time                  = date("H:i:s");

    $center             = $_POST['center'];
    $cbrno              =  $_POST['cbrno'];


    // $consent             = $_POST['consent'];
    // $sinovac             = $_POST['sinovac'];
    // $astrazeneca             = $_POST['astrazeneca'];
    // $pfizer             = $_POST['pfizer'];
    $vas_username       = $_POST['vas_username'];








    $insert_tbl_assesment_sql = "INSERT INTO tbl_assessment SET 
        
           date_reg             = :date_regg,
           time_reg             = :time_reg,
           remarks              = :remarks, 
           entity_no            = :entity_no,
           vas_username         = :vas,
           bakuna_center_no    = :cbrno,
           bakuna_center       =  :bc_name";

    $add_assesment_data = $con->prepare($insert_tbl_assesment_sql);
    $add_assesment_data->execute([
        ':entity_no'             => $entity_no,
        ':vas'                   => $vas_username,
        ':date_regg'              => $date_reg,
        ':time_reg'              => $time,
        ':remarks'               => $remarks,
        ':cbrno'                     => $cbrno,

        ':bc_name'               => $center


    ]);


    //update tbl_vaccine

    // $update_vaccine_sql = "UPDATE tbl_vaccine SET 
    // consent        = :consent,
    // sinovac       = :sinovac,
    // astrazeneca      = :astrazeneca,
    // pfizer = :pfizer

    // where entity_no = :entityNo ";

    // $update_vaccine_data = $con->prepare($update_vaccine_sql);
    // $update_vaccine_data->execute([
    //     ':entityNo'     => $entity_no,

    //     ':consent'        => $consent,
    //     ':sinovac'        => $sinovac,
    //     ':astrazeneca'        => $astrazeneca,
    //     ':pfizer'        => $pfizer



    // ]);

    if ($add_assesment_data) {

        $_SESSION['status'] = "Add Successful!";
        $_SESSION['status_code'] = "success";

        // header('location: list_vaccine_profile.php');
    } else {
        $_SESSION['status'] = "Add Unsuccessful!";
        $_SESSION['status_code'] = "error";

        // header('loca/tion: list_vaccine_profile.php');
    }
}
