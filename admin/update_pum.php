<?php

if (isset($_POST['update_pum'])) {

    $alert_msg = '';
    $alert_msg1 = '';
    $get_fullname = $_POST['fullname'];
    $get_date = $_POST['report_date'];
    $get_time = $_POST['report_time'];
    $get_symptoms = $_POST['name_symptoms'];
    $get_id = $_POST['idno'];
    $get_status = $_POST['status'];

    $update_pum_sql = " UPDATE tbl_pum SET
        date_report         = :datess,
        fullname            = :namesss,
        time_report         = :timesss,
        symptoms            = :symp,
        status              = :stat 
        where idno          = :id";
            
    $pum_data = $con->prepare($update_pum_sql);
    $pum_data->execute([
        ':datess'           => $get_date,
        ':namesss'          => $get_fullname,
        ':timesss'          => $get_time,
        ':symp'             => $get_symptoms,
        ':stat'             => $get_status,
        ':id'               => $get_id

        ]);

        $alert_msg .= ' 
        <div class="new-alert new-alert-success alert-dismissible">
            <i class="icon fa fa-success"></i>
            Data Updated.
        </div>     
      ';
    header('location: view_pum.php');

}
