<?php

include "dbconfig.php";


$dateSubmitted = date('Y-m-d');
$entity_no = $_POST["entity_no"];
$status = 'NEW SUBMISSION';
$photo = $_FILES["photo"]["name"];


    // --- photo location and generate unique photo name
    $currentDir = getcwd();
    $path = "verification_images/";
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $temp = explode('.', $_FILES['photo']['name']);
    $newfilename = round(microtime(true)) . $entity_no . '.' . end($temp);
    $uploadPath = $path . $newfilename;

    // --- uplaod photo
    move_uploaded_file($fileTmpName, $uploadPath);

    // - - - INSERT  Entity - - - / /
    $insert_entity_sql = "INSERT INTO tbl_verification SET 

        entity_no     = :entity_no,
        photo         = :photo,
        status        = :status
 
    ";

    $sql_data = $con->prepare($insert_entity_sql);
    $sql_data->execute([

        ':entity_no'    => $entity_no,  
        ':photo'        => $newfilename,
        ':status'       => $status


    ]);


?>