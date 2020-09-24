<?php



if (isset($_POST['add_juridical'])) {

    $id_juridical = uniqid('id', true);

    date_default_timezone_set('Asia/Manila');
    $alert_msg = '';
    $alert_msg1 = '';

    $ent_number = $_POST['entity_number'];
    $name_org = $_POST['name_org'];
    $org = $_POST['organization'];
    $nature_bus = $_POST['nature_bus'];
    $street_add = $_POST['street_add'];
    $brgy = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $admin_name = $_POST['admin_name'];
    $admin_position = $_POST['admin_position'];
    $mobile_no = $_POST['mobile_no'];
    $telephone_no = $_POST['tel_no'];
    $email_add = $_POST['email_add'];
    $date_reeg = date('Y-m-d', strtotime($_POST['date_reg']));
    $juri_username = $_POST['username'];
    $juri_password = $_POST['password'];
    $statssss = 'Active';
    $juri_pwhashed  = password_hash($juri_password, PASSWORD_DEFAULT);


    $insert_juridical_sql = "INSERT INTO tbl_juridical SET 
        entity_no               = :ent_no,
        date_reg                = :regis,
        org_name                = :name_org,
        organization            = :orggg,
        business_nature         = :buss_nature,
        street_address          = :streeet,
        barangay                = :brgysss,
        city                    = :city,
        province                = :provincee,
        administrator_name      = :adddmiin,
        admin_position          = :posss,
        mobile_number           = :mobiles,
        telephone_no            = :tel_nos,
        email_address           = :emaails,
        username                = :user,
        password                = :passs,
        status                  = :status";

    $juridical_data = $con->prepare($insert_juridical_sql);
    $juridical_data->execute([

        ':ent_no'               => $ent_number,
        ':regis'                => $date_reeg,
        ':name_org'             => $name_org,
        ':orggg'                => $org,
        ':buss_nature'          => $nature_bus,
        ':streeet'              => $street_add,
        ':brgysss'              => $brgy,
        ':city'                 => $city,
        ':provincee'            => $province,
        ':adddmiin'             => $admin_name,
        ':posss'                => $admin_position,
        ':mobiles'              => $mobile_no,
        ':tel_nos'              => $telephone_no,
        ':emaails'              => $email_add,
        ':user'                 => $juri_username,
        ':passs'                => $juri_pwhashed,
        ':status'               => $statssss


    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            <strong> Success ! </strong> Data Inserted.
        </div>      
    ';
}
