


<?php


include('../config/db_config.php');

if (isset($_POST['idno'])) {


    $idno = $_POST['idno'];
    $position = '';
 


    // $user_id = $_SESSION['id  //select all data type
    $get_all_category_sql = "SELECT * FROM `tbl_category_id` WHERE idno = :idno";
    $get_all_category_data = $con->prepare($get_all_category_sql);
    $get_all_category_data->execute([':idno' => $idno]);
    while ($result = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) {

        $idno =  $result['idno'];
        $categ_id_type =  $result['categ_id_type'];
      

    }

    $data = array(
        'statuscode' => 200,
        'data' => $idno,
        'data1' => $categ_id_type,
   
   


        'message' => 'success'
    );
    echo json_encode($data);
}
