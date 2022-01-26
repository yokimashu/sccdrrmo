<?php


// session_start();

// include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');




    $entity_no             = $_POST['entity_no'];

    $date_reg      = date('Y-m-d');
    $time                  = date("H:i:s");



   
    $insert_tnxhistory_sql = "INSERT INTO tbl_tnxhistory SET 
    ref        = :ref ,
    date        = :date ,
    entity_no        = :entity_no ,
  
  username     = :username,
  activity     = :activity


  ";


    $bakuna_tnxhistory_data = $con->prepare($insert_tnxhistory_sql);
    $bakuna_tnxhistory_data->execute([

        ':ref'                    => "ref:" . $entity_no,
        ':date'                   => $date_reg .' - '.$time,
        ':entity_no'              => $entity_no,
       
        ':username'               => $user_name,
        ':activity'               => $activity



    ]);

    


