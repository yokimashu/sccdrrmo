<?php

include "dbconfig.php";


$dateRegister = date('Y-m-d');

$username = $_POST["username"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$middlename = $_POST["middlename"];
$lastname = $_POST["lastname"];
$mobileno = $_POST["mobile_no"];
$telephoneno = $_POST["telephone_no"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$birthdate = $_POST["birthdate"];
$newbirthdate = date("Y-m-d", strtotime($birthdate));
$street = $_POST["street"];
$barangay = $_POST["barangay"];
$city = $_POST["city"];
$province = $_POST["province"];
$photo = $_FILES["photo"]["name"];

$status = "ACTIVE";
$type = "INDIVIDUAL";

$fullname = $firstname. ' ' .$middlename. ' ' .$lastname;
$hashed_password  = password_hash($password, PASSWORD_DEFAULT);

$age = date_diff(date_create($newbirthdate), date_create($dateRegister))->y;

// --- Check user if already exist
$get_entity_data_sql = "SELECT * FROM tbl_entity where username = :username";
$get_entity_data = $con->prepare($get_entity_data_sql);
$get_entity_data->execute([':username' => $username]);
$result = $get_entity_data->fetch(PDO::FETCH_ASSOC);

if ($result == 0) {

    //---generate entity number
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
    $serializedEntityID = $sernum;

    // --- photo location and generate unique photo name
    $currentDir = getcwd();
    $path = "images/";
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $temp = explode('.', $_FILES['photo']['name']);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $uploadPath = $path . $newfilename;

    // --- uplaod photo
    move_uploaded_file($fileTmpName, $uploadPath);

    // - - - INSERT  Entity - - - / /
    $insert_entity_sql = "INSERT INTO tbl_entity SET 

        entity_no     = :entity_no,
        username      = :username,
        password      = :password,
        type          = :type,
        status        = :status
 
    ";

    $sql_data = $con->prepare($insert_entity_sql);
    $sql_data->execute([

        ':entity_no'    => $serializedEntityID,
        ':username'     => $username,
        ':password'     => $hashed_password,
        ':type'         => $type,
        ':status'       => $status


    ]);

    // - - - Insert Individual - - - / /
    $insert_individual_sql = "INSERT INTO tbl_individual SET

            entity_no          = :entity_no,
            date_register      = :date_register,
            fullname           = :fullname,
            firstname          = :firstname,
            middlename         = :middlename,
            lastname           = :lastname,
            mobile_no          = :mobileno,
            telephone_no       = :telephoneno,
            email              = :email,
            gender             = :gender,
            birthdate          = :birthdate,
            age                = :age,
            street             = :street,
            barangay           = :barangay,
            city               = :city,
            province           = :province,
            photo              = :photo
            
        ";

    $indivdata = $con->prepare($insert_individual_sql);
    $indivdata->execute([
        ':entity_no'       => $serializedEntityID,
        ':date_register'   => $dateRegister,
        ':fullname'        => $fullname,
        ':firstname'       => $firstname,
        ':middlename'      => $middlename,
        ':lastname'        => $lastname,
        ':mobileno'        => $mobileno,
        ':telephoneno'     => $telephoneno,
        ':email'           => $email,
        ':gender'          => $gender,
        ':birthdate'       => $newbirthdate,
        ':age'             => $age,
        ':street'          => $street,
        ':barangay'        => $barangay,
        ':city'            => $city,
        ':province'        => $province,
        ':photo'           => $newfilename

    ]);

    echo json_encode('Success');
} else {
    echo json_encode('Username already exist!');
}
