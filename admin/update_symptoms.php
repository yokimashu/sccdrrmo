<?php

if (isset($_POST['update_symptoms'])) {

    $alert_msg = '';
    $alert_msg1 = '';
    $get_symptoms = $_POST['symptoms'];
    $get_id = $_POST['idno'];
    $get_status = $_POST['status'];

    $update_symptoms_sql = " UPDATE tbl_symptoms SET
        symptoms            = :symptoms,
        status              = :stat 
        where idno          = :id";
            
    $symptoms_data = $con->prepare($update_symptoms_sql);
    $symptoms_data->execute([
       
        ':symptoms'         => $get_symptoms,
        ':stat'             => $get_status,
        ':id'               => $get_id

        ]);

        $alert_msg .= ' 
        <div class="new-alert new-alert-success alert-dismissible">
            <i class="icon fa fa-success"></i>
            Data Updated.
        </div>     
      ';
    header('location: view_symptoms.php');

}
