<?php


include('../config/db_config.php');

if (isset($_POST['idno'])) {


    $idno = $_POST['idno'];

 


    // $user_id = $_SESSION['id  //select all data type
    $get_all_category_sql = "SELECT * FROM `tbl_category` WHERE idno = :idno";
    $get_all_category_data = $con->prepare($get_all_category_sql);
    $get_all_category_data->execute([':idno' => $idno]);
    while ($result = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) {

        $idno =  $result['idno'];
        $category =  $result['category'];
        $description =  $result['description'];

    }

    $data = array(
        'statuscode' => 200,
        'data' => $idno,
        'data1' => $category,
        'data2' => $description,
   


        'message' => 'success'
    );
    echo json_encode($data);
}
