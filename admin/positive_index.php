<?php


include('../config/db_config.php');

if (isset($_POST['patient_nos'])) {


    $entity_no = $_POST['patient_nos'];
    $fullname = '';
    $street = '';
    $patient_no = '';

    $barangay = '';
    $mobile_no = '';
    $photo = '';


    // $user_id = $_SESSION['id  //select all data type
    $get_all_individual_sql = "SELECT * FROM tbl_individual i INNER JOIN tbl_sources_infection sf 
                                ON i.entity_no = sf.patient_entityno WHERE sf.patient_entityno = :entity_no";
    $get_all_individual_data = $con->prepare($get_all_individual_sql);
    $get_all_individual_data->execute([':entity_no' => $entity_no]);
    while ($result = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) {


        $entity_no =  $result['entity_no'];
        $patient_no = $result['patient_no'];

        $fullname =  $result['fullname'];
        $street =  $result['street'];
        $barangay =  $result['barangay'];
        $mobile_no =  $result['mobile_no'];
        $photo =  $result['photo'];
    }

    $data = array(
        'statuscode' => 200,
        'data' => $entity_no,
        'data1' => $fullname,
        'data2' => $patient_no,



        'message' => 'success'
    );
    echo json_encode($data);
}
