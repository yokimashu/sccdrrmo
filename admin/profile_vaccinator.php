<?php


include('../config/db_config.php');

if (isset($_POST['vaccinator'])) {


    $vaccinator_name = $_POST['vaccinator'];
    $profession = '';

    // $user_id = $_SESSION['id  //select all data type
    $get_all_vaccinator_sql = "SELECT * FROM tbl_vaccinators where CONCAT(l_name, ', ', f_name, ' ', m_name) = :fullname";
    $get_all_vaccinator_sql = $con->prepare($get_all_vaccinator_sql);
    $get_all_vaccinator_sql->execute([':fullname' => $vaccinator_name]);
    while ($result = $get_all_vaccinator_sql->fetch(PDO::FETCH_ASSOC)) {

        $vaccinator_name = $result['fullname'];
        $profession =  $result['position'];
      
    }

    $data = array(
        'statuscode' => 200,
        'data' => $vaccinator_name,
        'data1' => $profession,
    );
    echo json_encode($data);
}
