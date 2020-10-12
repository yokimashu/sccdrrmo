<?php

$alert_msg = '';
include('../config/db_config.php');
if (isset($_POST['update_individual'])) {



    $get_date_register          = date('Y-m-d', strtotime($_POST['date_register']));
    $get_entity_no              = $_POST['entity_no'];
    $get_firstname              = $_POST['firstname'];
    $get_middlename             = $_POST['middlename'];
    $get_lastname               = $_POST['lastname'];
    $get_birthdate              = date('Y-m-d', strtotime($_POST['birthdate']));
    $get_age                    = $_POST['age'];
    $get_gender                 = $_POST['get_gender'];
    $get_street                 = $_POST['street'];
    $get_barangay               = $_POST['get_barangay'];
    $get_city                   = $_POST['city'];
    $get_province               = $_POST['province'];
    $get_mobile_no              = $_POST['mobile_no'];
    $get_telephone_no           = $_POST['telephone_no'];
    $get_email                  = $_POST['email'];
    $img                      =   $_POST['image'];
  
    $alert_msg = '';
    $alert_msg1 = '';
 
    $get_username               = $_POST['username'];
    $get_new_password           = $_POST['password'];
    $hashed_password  = password_hash($get_new_password, PASSWORD_DEFAULT);


    if (empty($get_new_password)) {

        $insert_individual_sql = "UPDATE tbl_individual SET 
        
           date_register        = :dateee,
           fullname            = :full_name,
           firstname            = :first_name,
           middlename           = :middle_name,
           lastname             = :last_name,
           gender               = :genders,
           birthdate            = :bdate,
           age                  = :ages,
           street               = :streets,
           barangay             = :brgys,
           city                 = :citys,
           province             = :province,
           mobile_no            = :mobile,
           telephone_no         = :telephone,
           email                = :email
            where entity_no      = :entityNo ";

        $add_individual_data = $con->prepare($insert_individual_sql);
        $add_individual_data->execute([
            ':entityNo'                 => $get_entity_no,
            ':dateee'                   => $get_date_register,
            ':full_name'                => $get_firstname . ' ' . $get_middlename . ' ' . $get_lastname,
            ':first_name'               => $get_firstname,
            ':middle_name'              => $get_middlename,
            ':last_name'                => $get_lastname,
            ':genders'                  => $get_gender,
            ':bdate'                    => $get_birthdate,
            ':ages'                     => $get_age,
            ':streets'                  => $get_street,
            ':brgys'                    => $get_barangay,
            ':citys'                    => $get_city,
            ':province'                 => $get_province,
            ':mobile'                   => $get_mobile_no,
            ':telephone'                => $get_telephone_no,
            ':email'                    => $get_email
           
        ]);
    } else {

        $insert_individual_sql = "UPDATE tbl_individual SET 
        
        date_register        = :dateee,
        fullname            = :full_name,
        firstname            = :first_name,
        middlename           = :middle_name,
        lastname             = :last_name,
        gender               = :genders,
        birthdate            = :bdate,
        age                  = :ages,
        street               = :streets,
        barangay             = :brgys,
        city                 = :citys,
        province             = :province,
        mobile_no            = :mobile,
        telephone_no         = :telephone,
        email                = :email
             where entity_no      = :entityNo ";

        $add_individual_data = $con->prepare($insert_individual_sql);
        $add_individual_data->execute([
            ':entityNo'                 => $get_entity_no,
            ':dateee'                   => $get_date_register,
            ':full_name'                => $get_firstname . ' ' . $get_middlename . ' ' . $get_lastname,
            ':first_name'               => $get_firstname,
            ':middle_name'              => $get_middlename,
            ':last_name'                => $get_lastname,
            ':genders'                  => $get_gender,
            ':bdate'                    => $get_birthdate,
            ':ages'                     => $get_age,
            ':streets'                  => $get_street,
            ':brgys'                    => $get_barangay,
            ':citys'                    => $get_city,
            ':province'                 => $get_province,
            ':mobile'                   => $get_mobile_no,
            ':telephone'                => $get_telephone_no,
            ':email'                    => $get_email
           
        ]);


        $insert_entity_sql = "UPDATE tbl_entity SET  
        username            = :username,
        password            = :password
        where entity_no     = :entity";


        $entity_data = $con->prepare($insert_entity_sql);
        $entity_data->execute([

            ':entity'           => $get_entity_no,
            ':username'         => $get_username,
            ':password'         => $hashed_password

        ]);
        if($img != '' ){
            $folderPath = "../flutter/images/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.jpg';        
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            $update_photo = "update tbl_individual set photo = :photo where entity_no = :entity";
            $exe_update= $con->prepare($update_photo);
            $exe_update->execute([':photo' =>$fileName,
                                ':entity' =>$get_entity_no]);
            $get_photo = $fileName;
            $check_update_photo = $fileName;
        // echo "<p>";
        // echo print_r($check_update_photo);
        // echo "</p>";
        // echo "<p>";
        // echo print_r($fileName);
        // echo "</p>";
        };
        
        $alert_msg .= ' 
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>You have successfully deleted the employee.
        </div>     
    ';
    }

  
}
