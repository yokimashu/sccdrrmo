<?php


session_start();

include('../config/db_config.php');

if (isset($_POST['entity_no'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

$entity_no = $_POST['entity_no'];



//select * documents
$get_entityno_sql= "SELECT * FROM `tbl_individual` where entity_no = :entity_no";
$get_entityno_data = $con->prepare($get_entityno_sql);
$get_entityno_data->execute(['entity_no'=>$entity_no]);
while ($result1 = $get_entityno_data->fetch(PDO::FETCH_ASSOC)) {
 $entity_no =  $result1['entity_no'];
 $firstname = $result1['firstname'];
 $lastname = $result1['lastname'];
 $middlename = $result1['middlename'];

}



// $response = array(
//  'docno' => $docno,
//  'particulars' => $particulars

// );
$data = array(
    'entity_no'        => $entity_no,
    'firstname'        => $firstname,
    'lastname'         => $lastname,
    'middlename'      => $middlename,


);
echo json_encode($data);
//echo $date, $particulars;
die();

}
?>