<?php


include('../config/db_config.php');


if (isset($_POST['update_juridical'])) {



    $get_date_register          = date('Y-m-d', strtotime($_POST['date_register']));
    $get_entity_no              = $_POST['entity_no'];
    $get_org_type               = $_POST['org_type'];
    $get_bus_nature             = $_POST['get_nature'];
    $get_org_name               = $_POST['org_name'];
    $get_street                 = $_POST['street'];
    $get_brgy                   = $_POST['get_barangay'];
    $get_city                   = $_POST['city'];
    $get_province               = $_POST['province'];
    $get_contact_name           = $_POST['contact_person'];
    $get_contact_pos            = $_POST['contact_position'];
    $get_mobile_no              = $_POST['mobile_no'];
    $get_tel_no                 = $_POST['telephone_no'];
    $get_email                  = $_POST['email'];
    $alert_msg = '';
    $alert_msg1 = '';

    $get_username               = $_POST['username'];
    $get_new_password           = $_POST['password'];
    $hashed_password  = password_hash($get_new_password, PASSWORD_DEFAULT);


    if (empty($get_new_password)) {

        $insert_juridical_sql = "UPDATE tbl_juridical SET 
           date_reg             = :dateee,
           org_name             = :orgnamee,
           org_type             = :orgtypeee,
           business_nature      = :natureee,
           street               = :streeet,
           barangay             = :brgy,
           city                 = :city,
           province             = :province,
           contact_name         = :cname,
           contact_position     = :cposition,
           mobile_no            = :mobilee,
           telephone_no        = :teleephone,
           email_address        = :email_add
           where entity_no      = :entityNo ";

        $update_juridical_data = $con->prepare($insert_juridical_sql);
        $update_juridical_data->execute([

            ':entityNo'                 => $get_entity_no,
            ':dateee'                   => $get_date_register,
            ':orgnamee'                 => $get_org_name,
            ':orgtypeee'                => $get_org_type,
            ':natureee'                 => $get_bus_nature,
            ':streeet'                  => $get_street,
            ':brgy'                     => $get_brgy,
            ':city'                     => $get_city,
            ':province'                 => $get_province,
            ':cname'                    => $get_contact_name,
            ':cposition'                => $get_contact_pos,
            ':mobilee'                  => $get_mobile_no,
            ':teleephone'               => $get_tel_no,
            ':email_add'                => $get_email

        ]);
    } else {



        $insert_juridical_sql = "UPDATE tbl_juridical SET 
           date_reg             = :dateee,
           org_name             = :orgnamee,
           org_type             = :orgtypeee,
           business_nature      = :natureee,
           street               = :streeet,
           barangay             = :brgy,
           city                 = :city,
           province             = :province,
           contact_name         = :cname,
           contact_position     = :cposition,
           mobile_no            = :mobilee,
           telephone_no        = :teleephone,
           email_address        = :email_add
           where entity_no      = :entityNo ";

        $update_juridical_data = $con->prepare($insert_juridical_sql);
        $update_juridical_data->execute([

            ':entityNo'                 => $get_entity_no,
            ':dateee'                   => $get_date_register,
            ':orgnamee'                 => $get_org_name,
            ':orgtypeee'                => $get_org_type,
            ':natureee'                 => $get_bus_nature,
            ':streeet'                  => $get_street,
            ':brgy'                     => $get_brgy,
            ':city'                     => $get_city,
            ':province'                 => $get_province,
            ':cname'                    => $get_contact_name,
            ':cposition'                => $get_contact_pos,
            ':mobilee'                  => $get_mobile_no,
            ':teleephone'               => $get_tel_no,
            ':email_add'                => $get_email

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
    }

    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Updated.
    </div>      
';
}
