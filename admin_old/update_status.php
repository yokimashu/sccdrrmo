<?php

$alert_msg = '';
include('../config/db_config.php');
if (isset($_POST['update_status'])) {



    // $get_date_register          = date('Y-m-d', strtotime($_POST['date_register']));
    $get_objid             = $_POST['objid'];
    $get_status             = $_POST['status'];


    $alert_msg = '';
    $alert_msg1 = '';




    $insert_status_sql = "UPDATE tbl_closecontact SET 
        
       
           status            = :status
      WHERE objid =  $get_objid ";

    $add_status_data = $con->prepare($insert_status_sql);
    $add_status_data->execute([
        ':status'                 => $get_status


    ]);










    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Inserted.
</div>    
    ';
}
