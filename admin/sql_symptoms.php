<?php

    include ('../config/db_config.php');

    if (isset($_POST['insert_symptoms'])) {

     
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







