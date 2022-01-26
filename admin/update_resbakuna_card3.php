<?php

include('../config/db_config.php');


session_start();

date_default_timezone_set('Asia/Manila');

$alert_msg = '';


if (isset($_POST['update_resbakuna_card3'])) {

    $entity_no             = $_POST['entity_no'];
    $get_objid             = $_POST['card'];
    $date_reg               = $_POST['tnx_date'];
    $entity_no             = $_POST['entity_no'];
    $username             = $_POST['username'];


    $get_actions             = "1";

    $activity             = "PRINT VAMOS RESBAKUNA CARD";

    $alert_msg = '';
    $alert_msg1 = '';


 

    $insert_status_sql = "UPDATE tbl_assessment SET 
       
    actions            = :actions

    where entity_no         = :entityno
  
";

$add_status_data = $con->prepare($insert_status_sql);
$add_status_data->execute([
   
    ':actions'                 => $get_actions,
    ':entityno'                     => $entity_no




]);

    $insert_tnxhistory_sql = "INSERT INTO tbl_tnxhistory SET 
    ref        = :ref ,
    date        = :date ,
    entity_no        = :entity_no ,
  actions        = :actions ,
  username     = :username,
  activity     = :activity
  
  ";


  $bakuna_tnxhistory_data = $con->prepare($insert_tnxhistory_sql);
  $bakuna_tnxhistory_data->execute([

      ':ref'            =>"tbl_assessment:" . $get_objid,
      ':date'            => $date_reg,
      ':entity_no'            => $entity_no,
      ':actions'            => $get_actions,
      ':username'            => $username,
      ':activity'            => $activity



  ]);
    

    if ($assessment_data) {

        $_SESSION['status'] = "Update Successful!";
        $_SESSION['status_code'] = "success";

        header('location: ../plugins/jasperreport/vaccination_card_3rd_janssen.php?entity_no=' . $entity_no);
    } else {
        $_SESSION['status'] = "Print Resbakuna Card only Once";
        $_SESSION['status_code'] = "error";

        header('location: ../plugins/jasperreport/vaccination_card_3rd_janssen.php?entity_no=' . $entity_no);
    }
}
