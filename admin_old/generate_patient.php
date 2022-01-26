<?php




include('../config/db_config.php');

if (isset($_POST['entity_no'])) {
  //     echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  $finalcount = null;
  $finalcount1 = null;
  $finaltype = null;
  $obr = null;
  $entity_no = $_POST['entity_no'];


  //  count no. of documents
  $get_items_sql = "SELECT COUNT(`patient_no`) as total FROM `tbl_sources_infection` ";
  $get_items_data = $con->prepare($get_items_sql);
  $get_items_data->execute([':entityno' => $entity_no]);
  $get_items_data->setFetchMode(PDO::FETCH_ASSOC);
  while ($result1 = $get_items_data->fetch(PDO::FETCH_ASSOC)) {
    $finalcount =  $result1['total'];
  }

  //generate document no
  $finalcount1 =  $finalcount + 1;

  $patient_no = 'SCC' .  $finalcount1;


  //     }else{
  //  $docno = $finaltype;
  //     $docno =$department.date('Y').$sernum;
  echo $patient_no;
}




// //$data = array(
//   'docno'        => $docno,
//   'obrno'        => $obr,
//   // 'dvno'         => $dv,
// );
// //echo json_encode($data);

die();
