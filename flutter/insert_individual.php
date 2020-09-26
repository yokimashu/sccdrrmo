<?php

include "dbconfig.php";


$dateRegister = date('m-d-Y');

$username = $_POST["username"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$middlename = $_POST["middlename"];
$lastname = $_POST["lastname"];
$contactno = $_POST["contactno"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$birthdate = $_POST["birthdate"];
$newbirthdate = date("m-d-Y", strtotime($birthdate));
$street = $_POST["street"];
$baranggay = $_POST["baranggay"];
$city = $_POST["city"];
$province = $_POST["province"];
$photo = $_FILES["photo"]["name"];

$status = "active";
$type = "individual";


$hashed_password  = password_hash($password, PASSWORD_DEFAULT);

// --- Check user if already exist
$get_user1_sql = "SELECT * FROM tbl_entity where username = :username";
$user_data1 = $con->prepare($get_user1_sql);
$user_data1->execute([':username' => $username]);
$result = $user_data1->fetch(PDO::FETCH_ASSOC);

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
            firstname          = :firstname,
            middlename         = :middlename,
            lastname           = :lastname,
            contact_no         = :contactno,
            email_address      = :email,
            gender             = :gender,
            birthdate          = :birthdate,
            street             = :street,
            baranggay          = :baranggay,
            city               = :city,
            province           = :province,
            photo              = :photo
            
        ";

    $indivdata = $con->prepare($insert_individual_sql);
    $indivdata->execute([
        ':entity_no'       => $serializedEntityID,
        ':date_register'   => $dateRegister,
        ':firstname'       => $firstname,
        ':middlename'      => $middlename,
        ':lastname'        => $lastname,
        ':contactno'       => $contactno,
        ':email'           => $email,
        ':gender'          => $gender,
        ':birthdate'       => $newbirthdate,
        ':street'          => $street,
        ':baranggay'       => $baranggay,
        ':city'            => $city,
        ':province'        => $province,
        ':photo'           => $newfilename

    ]);

    echo json_encode('Registration Success!');
} else {
    echo json_encode('Username already exist!');
}
