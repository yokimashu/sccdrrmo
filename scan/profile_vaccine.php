<?php

include('../config/db_config.php');
date_default_timezone_set('Asia/Manila');
$newdate = date("Y-m-d");
$newtime = date("H:i:s");



if (isset($_POST['entity_no'])) {


    $entity_no = $_POST['entity_no'];
    $fullname = '';
    $firstname = ' ';
    $middlename = ' ';
    $lastname = '';
    $street = '';
    $age = ' ';
    $birthdate = ' ';
    $email = ' ';
    $province = ' ';
    $gender = ' ';
    $city = ' ';
    $barangay = '';
    $mobile_no = '';
    $status = ' ';
    $photo = '';


    // $user_id = $_SESSION['id  //select all data type
    $get_all_individual_sql = "SELECT * FROM `tbl_individual` i inner join tbl_entity e on i.entity_no = e.entity_no WHERE i.entity_no = :entity_no";
    $get_all_individual_data = $con->prepare($get_all_individual_sql);
    $get_all_individual_data->execute([':entity_no' => $entity_no]);


    while ($result = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) {


        $entityno =  $result['entity_no'];

        $fullname =  $result['fullname'];
        $firstname = $result['firstname'];

        $middlename = $result['middlename'];
        $lastname = $result['lastname'];
        $email = $result['email'];
        $birthdate = $result['birthdate'];
        $province = $result['province'];
        $street =  $result['street'];
        $barangay =  $result['barangay'];
        $age = $result['age'];
        $gender = $result['gender'];
        $city = $result['city'];
        $status = $result['status'];

        $mobile_no =  $result['mobile_no'];
        $photo =  $result['photo'];
    }
    $data = array(
        'statuscode' => 200,
        'data' => $entityno,
        'data1' => $fullname,
        'data2' => $firstname,
        'data3' => $middlename,
        'data4' => $lastname,
        'data5' => $birthdate,
        'data6' => $province,
        'data7' => $street,
        'data8' => $barangay,
        'data9' => $age,
        'data10' => $gender,
        'data11' => $city,
        'data12' => $mobile_no,
        'data13' => $photo,
        'data14' => $email,
        'data15' => $status,
        'message' => 'success'
    );
    echo json_encode($data);

    $insert_history_sql = "INSERT INTO tbl_tracehistory SET 

    date           = :date,
    time           = :time,
    entity_no      = :entity_no,
    trace_no       = 'SCANNER'";

    $history_data = $con->prepare($insert_history_sql);
    $history_data->execute([

        ':date'          => $newdate,
        ':time'          => $newtime,
        ':entity_no'     => $entityno   
        // ':trace_no'      => 'SCANNER'
    ]);
    
}
