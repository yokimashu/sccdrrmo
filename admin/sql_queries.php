<?php

    include ('../config/db_config.php');

    if (isset($_POST['add_pum'])) {  

        $id_pum = uniqid('id',true);
        date_default_timezone_set('Asia/Manila');
        
        $firstname              = $_POST['firstname'];
        $middlename             = $_POST['middlename'];
        $lastname               = $_POST['lastname'];
        $age                    = $_POST['age'];
        $gender                 = $_POST['gender'];
        $brgy                   = $_POST['barangay'];
        $street                 = $_POST['street'];
        $city                   = $_POST['city'];
        $province               = $_POST['province'];
        $city_origin            = $_POST['city0rigin'];
        $arrival                = date('Y-m-d', strtotime($_POST['date_arrival']));
        $contact_number         = $_POST['contact_number'];
        $travel_days            = $_POST['travel_days'];
        $patient_disease        = $_POST['disease'];
        $symptoms               = $_POST['symptoms'];
        $health_status          = $_POST['health_status'];
        $process                = date('Y-m-d', strtotime($_POST['date_process']));        
        
        $time = date('h:i:s');
        $status = 'Active';
        $alert_msg = '';
        $alert_msg1 = '';

        $insert_pum_sql = "INSERT INTO tbl_pum SET 
            objid               = :id,
            date_report         = :dates,
            time_report         = :timess,
            first_name          = :firstName,
            middle_name         = :middleName,
            last_name           = :lastName,
            age                 = :age,
            gender              = :gender,
            barangay            = :brgy,
            street              = :streets,
            city                = :citys,
            province            = :prov,
            city_origin         = :origin,
            date_arrival        = :arrival,
            contact_number      = :contact,
            travel_days         = :travel,
            patient_disease     = :disease,
            health_status       = :health,
            symptoms            = :symp,
            status              = :status";
            
        $pum_data = $con->prepare($insert_pum_sql);
        $pum_data->execute([
            ':id'               => $id_pum,
            ':dates'            => $process,
            ':timess'           => $time,
            ':firstName'        => $firstname,
            ':middleName'       => $middlename,
            ':lastName'         => $lastname,
            ':age'              => $age,
            ':gender'           => $gender,
            ':brgy'             => $brgy,
            ':streets'          => $street,
            ':citys'            => $city,
            ':prov'             => $province,
            ':origin'           => $city_origin,
            ':arrival'          => $arrival,
            ':contact'          => $contact_number,
            ':travel'           => $travel_days,
            ':disease'          => $patient_disease,
            ':health'           => $health_status,
            ':symp'             => $symptoms, 
            ':status'           => $status
         
            ]);

        $alert_msg .= ' 
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check-double"></i>
                <strong> Success ! </strong> Data Inserted.
            </div>      
        ';
        
        $btnSave = 'disabled';
        $btnNew = 'enabled';



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
    else if (isset($_POST['delete_symptoms'])) {

        $delete_user_id = $_POST['user_id'];
        $delete_user_sql = "UPDATE tbl_symptoms SET status ='Inactive' WHERE idno = :id ";
        $delete_user_data = $con->prepare($delete_user_sql);
        $delete_user_data->execute([':id'=>$delete_user_id]);
    
        header('location: list_symptoms.php');
        
    }
    
        




   









