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
            
        $add_pum_data = $con->prepare($insert_pum_sql);
        $add_pum_data->execute([
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
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
            </div>      
        ';
        
        $btnSave = 'disabled';
        $btnNew = 'enabled';



    }

    else if (isset($_POST['update_pum'])) {
   
       $alert_msg = '';
       $alert_msg1 = '';
       $get_fName               = $_POST['get_fName'];
       $get_mName               = $_POST['get_mName'];
       $get_lName               = $_POST['get_lName'];
       $get_age                 = $_POST['get_age'];
       $get_gender              = $_POST['get_gender'];
       $get_brgy                = $_POST['get_barangay'];
       $get_street              = $_POST['get_street'];
       $get_city                = $_POST['get_city'];
       $get_province            = $_POST['get_province'];
       $get_origin              = $_POST['get_city0rigin'];
       $get_contact             = $_POST['get_number'];
       $get_travel              = $_POST['get_travel'];
       $get_disease             = $_POST['get_disease'];
       $get_symptoms            = $_POST['get_symptoms'];
       $get_health              = $_POST['get_health'];
       $get_health              = $_POST['get_health'];
       $get_cleared             = date('Y-m-d', strtotime($_POST['get_cleared']));        
       $get_time                = date('h:i:s');
   
       $update_pum_sql = " UPDATE tbl_pum SET
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
            date_cleared        = :cleared
            where idno          = :id";
               
       $update_pum_data = $con->prepare($update_pum_sql);
       $update_pum_data->execute([
           ':cleared'         => $get_cleared,
           ':firstName'       => $get_id,
           ':middleName'      => $get_fullname,
           ':lastName'        => $get_time,
           ':age'             => $get_symptoms,
           ':gender'          => $get_status,
           ':brgy'            => $get_id,
           ':streets'         => $get_id,
           ':citys'           => $get_id,
           ':prov'            => $get_id,
           ':origin'          => $get_id,
           ':arrival'         => $get_id,
           ':contact'         => $get_id,
           ':travel'          => $get_id,
           ':disease'         => $get_id,
           ':citys'             => $get_id,

   
           ]);
   
           $alert_msg .= ' 
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Updated.
            </div>     
         ';
   
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
    
        




   









