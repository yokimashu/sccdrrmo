<?php

    include ('../config/db_config.php');

    if (isset($_POST['insert_pum'])) {  

        $categUnique = uniqid('id',true);
        date_default_timezone_set('Asia/Manila');
        $symptoms = $_POST['get_symptoms'];
        $patient = $_POST['fullname'];
        $date = date('Y-m-d');
        $time = date('h:i:s');
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

    else if (isset($_POST['insert_symptoms'])) {

        
        $symptoms = $_POST['symptoms'];
        $status = 'Active';
        $alert_msg = '';
        $alert_msg1 = '';

        $insert_symptoms_sql = "INSERT INTO tbl_symptoms SET 
            symptoms            = :symp,
            status              = :status";
            
        $symptoms_data = $con->prepare($insert_symptoms_sql);
        $symptoms_data->execute([

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

        header('location: list_symptoms.php');

    }
    else if (isset($_POST['update_symptoms'])) {
    
        $alert_msg = '';
        $alert_msg1 = '';
        $get_symptoms = $_POST['symptoms'];
        $get_id = $_POST['id_number'];
        $get_status = $_POST['status'];
    
        $update_symptoms_sql = "UPDATE tbl_symptoms SET
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
    




   









