<?php

$alert_msg = '';
include('../config/db_config.php');
if (isset($_POST['update_void'])) {



    // $get_date_register          = date('Y-m-d', strtotime($_POST['date_register']));
    $get_objid             = $_POST['objid'];
    $get_remarks             = $_POST['remarks'];
    $get_status             = "VOID";


    $alert_msg = '';
    $alert_msg1 = '';




    $insert_status_sql = "UPDATE tbl_assessment SET 
        
       
           status            = :status,
           remarks            = :remarks
      WHERE objid =  $get_objid ";

    $add_status_data = $con->prepare($insert_status_sql);
    $add_status_data->execute([
        ':status'                 => $get_status,
        ':remarks'                 => $get_remarks


    ]);










    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Inserted.
</div>    
    ';
}
