<?php


include('../config/db_config.php');


if (isset($_POST['update_seatranspo'])) {



    $get_date_register          = date('Y-m-d', strtotime($_POST['date_register']));
    $get_entity_no              = $_POST['entity_no'];
    $get_categ_type             = $_POST['sea_category'];
    $get_vessel_name            = $_POST['vessel_name'];
    $get_voyage_no              = $_POST['voyage_no'];
    $get_embarkation            = $_POST['port_embarkation'];
    $get_contact_name           = $_POST['contact_name'];
    $get_contact_pos            = $_POST['contact_position'];
    $get_mobile_no              = $_POST['mobile_no'];
    $get_tel_no                 = $_POST['telephone_no'];
    $get_email                  = $_POST['email'];
    $alert_msg = '';
    $alert_msg1 = '';

    $get_username               = $_POST['username'];
    $get_new_password           = $_POST['password'];
    $hashed_password            = password_hash($get_new_password, PASSWORD_DEFAULT);


    if (empty($get_new_password)) {

        $insert_sea_sql = "UPDATE tbl_seatranspo SET 
           date_register            = :dateee,
           trans_type               = :categname,
           vessel_name              = :vessel,
           voyage_no                = :voyage,
           port_embarkation         = :port,
           contact_name             = :cname,
           contact_position         = :cposition,
           mobile_no                = :mobilee,
           telephone_no             = :teleephone,
           email                    = :email_add
           where entity_no          = :entityNo ";

        $update_sea_data = $con->prepare($insert_sea_sql);
        $update_sea_data->execute([

            ':entityNo'                 => $get_entity_no,
            ':dateee'                   => $get_date_register,
            ':categname'                => $get_categ_type,
            ':vessel'                   => $get_vessel_name,
            ':voyage'                   => $get_voyage_no,
            ':port'                     => $get_embarkation,
            ':cname'                    => $get_contact_name,
            ':cposition'                => $get_contact_pos,
            ':mobilee'                  => $get_mobile_no,
            ':teleephone'               => $get_tel_no,
            ':email_add'                => $get_email

        ]);
    }
    // else {







    //     $insert_entity_sql = "UPDATE tbl_entity SET  
    //     username            = :username,
    //     password            = :password
    //     where entity_no     = :entity";


    //     $entity_data = $con->prepare($insert_entity_sql);
    //     $entity_data->execute([

    //         ':entity'           => $get_entity_no,
    //         ':username'         => $get_username,
    //         ':password'         => $hashed_password

    //     ]);
    // }

    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> Data Updated.
    </div>      
';
}
