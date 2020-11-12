<?php

include "dbconfig.php";


$date_register = date('Y-m-d');

$username = $_POST["username"];
$password = $_POST["password"];

$transType = $_POST['trans_type'];
$vesselName = $_POST['vessel_name'];
$voyageNo = $_POST['voyage_no'];
$portEmbark = $_POST['port_embarkation'];

$contact_person = $_POST["contact_name"];
$contact_position = $_POST["contact_position"];
$mobile_no = $_POST["mobile_no"];
$telephone_no = $_POST["telephone_no"];
$email_address = $_POST["email"];

$photo = $_FILES["photo"]["name"];

$status = "ACTIVE";
$type = "SEA TRANSPORTATION";

$hashed_password  = password_hash($password, PASSWORD_DEFAULT);

// --- Check user if already exist
$get_entity_data_sql = "SELECT * FROM tbl_entity where username = :username";
$get_entity_data = $con->prepare($get_entity_data_sql);
$get_entity_data->execute([':username' => $username]);
$result = $get_entity_data->fetch(PDO::FETCH_ASSOC);

if ($result == 0) {

    //---generate entity number
    function generateEntityID()
    {
        global $entity_no;

        $template = 'XXXXXX9999';
        $k = strlen($template);
        $sernum = '';
        for ($i = 0; $i < $k; $i++) {
            switch ($template[$i]) {
                case 'X':
                    $sernum .= chr(rand(65, 90));
                    break;
                case '9':
                    $sernum .= rand(0, 9);
                    break;
                case '-':
                    $sernum .= '-';
                    break;
            }
        }
        $entity_no = $sernum;

        checkEntityID();
    }

    //---check if entity number is not duplicate
    function checkEntityID()
    {

        global $con;
        global $entity_no;

        $check_entity_sql = "SELECT * FROM tbl_entity where entity_no = :entity";
        $check_entity_data = $con->prepare($check_entity_sql);
        $check_entity_data->execute([':entity' => $entity_no]);

        $entity_count = $check_entity_data->rowCount();

        if ($entity_count != 0) {
            generateEntityID();
        }
    }

    generateEntityID();

    // --- photo location and generate unique photo name
    $currentDir = getcwd();
    $path = "images/";
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $temp = explode('.', $_FILES['photo']['name']);
    $newfilename = round(microtime(true)) . $vesselName . '.' . end($temp);
    $uploadPath = $path . $newfilename;

    // --- uplaod photo
    move_uploaded_file($fileTmpName, $uploadPath);

    // - - - INSERT  Entity - - - / /
    $insert_entity_sql = "INSERT INTO tbl_entity SET 
    entity_no           = :entity_no,
    username            = :username,
    password            = :password,
    type                = :type,
    status              = :status";


    $entity_data = $con->prepare($insert_entity_sql);
    $entity_data->execute([

        ':entity_no'        => $entity_no,
        ':username'         => $username,
        ':password'         => $hashed_password,
        ':type'             => $type,
        ':status'           => $status

    ]);

    // - - - Insert Juridical - - - / /

    $insert_juridical_sql = "INSERT INTO tbl_seatranspo SET 

        entity_no           = :entity_no,
        date_register       = :date_register,
        trans_type          = :trans_type,
        vessel_name         = :vessel_name,
        voyage_no           = :voyage_no,
        port_embarkation    = :port_embarkation,
        contact_name        = :contact_name,
        contact_position    = :position,
        mobile_no           = :mobile_no,
        telephone_no        = :telephone_no,
        email               = :email_address,
        photo               = :photo
        
        ";

    $juridical_data = $con->prepare($insert_juridical_sql);
    $juridical_data->execute([

        ':entity_no'         => $entity_no,
        ':date_register'     => $date_register,
        ':trans_type'        => $transType,
        ':vessel_name'       => $vesselName,
        ':voyage_no'         => $voyageNo,
        ':port_embarkation'  => $portEmbark,
        ':contact_name'      => $contact_person,
        ':position'          => $contact_position,
        ':mobile_no'         => $mobile_no,
        ':telephone_no'      => $telephone_no,
        ':email_address'     => $email_address,
        ':photo'             => $newfilename

    ]);

    echo json_encode('Success');
} else {
    echo json_encode('Username already exist!');
}

?>