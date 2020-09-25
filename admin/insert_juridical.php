<?php



//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';

if (isset($_POST['insert_juridical'])) {


    $entity_no = $_POST['entity_no'];
    date_default_timezone_set('Asia/Manila');

    $register               = date('Y-m-d', strtotime($_POST['date_reg']));
    $name_org               = $_POST['name_org'];
    $org                    = $_POST['organization'];
    $nature_bus             = $_POST['nature_bus'];
    $street_add             = $_POST['street_add'];

    $insert_juridical_sql = "INSERT INTO tbl_juridical SET 

        entity_no           = :entity_no,
        date_reg            = :regg,
        org_name            = :naaamee,
        organization        = :organization,
        business_nature     = :business,
        street_address      = :addreess
        -- barangay            = :brrgy,
        -- city                = :cityss,
        -- province            = :provvv,
        -- administrator_name  = :adddmin,
        -- admin_position      = :position,
        -- mobile_number       = :mobilee,
        -- telephone_no        = :teleee,
        -- email_address       = :email,
        -- username            = :useers,
        -- password            = :passs,
        -- status              = :staat";

    $juridical_data = $con->prepare($insert_juridical_sql);
    $juridical_data->execute([



        ':entity_no'         => $entity_no,
        ':regg'              => $register,
        ':naaamee'          => $name_org,
        ':organization'     => $org,
        ':business'         => $na
        // ':addreess'         =>




    ]);

    $alert_msg .= ' 
    <div class="new-alert new-alert-success alert-dismissible">
        <i class="icon fa fa-success"></i>
        Data Inserted
    </div>  
      ';
    // echo print_r($firstname);
    header("location: list_juridical.php");
}
