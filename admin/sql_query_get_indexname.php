<?php


include ('../config/db_config.php');

if (isset($_POST['entity_no'])) {


  $entity_no = $_POST['entity_no'];
  $fullname = '';
  $street = '';
  $barangay = '';
  $mobile_no = '';
  $photo = '';
  

  // $user_id = $_SESSION['id  //select all data type
  $get_all_individual_sql = "SELECT * FROM `tbl_individual` WHERE entity_no = :entity_no";
  $get_all_individual_data = $con->prepare($get_all_individual_sql);
  $get_all_individual_data->execute([':entity_no'=> $entity_no]);  
   while ($result = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)) {
    
    
    $entity_no =  $result['entity_no'];
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
    'data2' => $street,
    'data3' => $barangay,
    'data4' => $mobile_no,
    'data5' => $photo,


  
    'message' => 'success'
  );
  echo json_encode($data);










}
