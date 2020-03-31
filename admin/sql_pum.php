<?php

    include ('../config/db_config.php');

    if (isset($_POST['insert_pum'])) {

     
        $symptoms = $_POST['get_symptoms'];
        $patient = $_POST['fullname'];
        $date = $_POST['report_date'];
        $time = $_POST['report_time'];
        $status = 'Active';
        $alert_msg = '';
        $alert_msg1 = '';

        $insert_pum_sql = "INSERT INTO tbl_pum SET 
            date_report         = :dates,
            fullname            = :names,
            time_report         = :timess,
            symptoms            = :symp,
            status              = :status";
            
        $pum_data = $con->prepare($insert_pum_sql);
        $pum_data->execute([
            ':dates'            => $date,
            ':names'            => $patient,
            ':timess'           => $time,
            ':symp'             => $symptoms, 
            ':status'           => $status
         
            ]);

        $alert_msg .= ' 
            <div class="new-alert new-alert-success alert-dismissible">
                <i class="icon fa fa-success"></i>
                Data Inserted
            </div>     
        ';
        
        $btnSave = 'disabled';
        $btnNew = 'enabled';

        header('location: list_pum.php');

    }

    else if (isset($_POST['update_pum'])) {

        $alert_msg = '';
        $get_fullname = $_POST['fullname'];
        $get_date = $_POST['report_date'];
        $get_time = $_POST['report_time'];
        $ge_symptomsss = $_POST['symptomlk'];
        $get_id = $_POST['idno'];
    
       
        $update_categ_sql = "UPDATE tbl_pum SET
            date_report         = :datess,
            fullname            = :namesss,
            time_report         = :timesss,
            symptoms            = :symp,
            status              = :stat, 

            where idno      = :id";
                
        $update_data = $con->prepare($update_categ_sql);
        $update_data->execute([
            ':datess'           => $get_id,
            ':namesss'          => $get_category,
            ':timesss'          => $get_code,
            ':symp'             => $get_code,
            ':stat'             => $get_status
            ]);
    
            $alert_msg .= ' 
            <div class="new-alert new-alert-success alert-dismissible">
                <i class="icon fa fa-success"></i>
                Data Updated.
            </div>     
          ';
        header('location: view_pum.php');
    
    }










