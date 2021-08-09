<?php

include('../config/db_config.php');

if (isset($_POST['cbr_no'])) {
  //     echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  global $cbrno;

  $finalcount = null;
  $finalcount1 = null;
  $final_cbrno = null;



  $cbr_no = $_POST['cbr_no'];
  // $user_id = $_SESSION['id'];


  //select all data type
  $get_category_sql = "SELECT `bc_code` FROM `tbl_bakuna_center` WHERE bc_name = :cbr_no";
  $get_category_data = $con->prepare($get_category_sql);
  $get_category_data->execute([':cbr_no' => $cbr_no]);
  while ($result = $get_category_data->fetch(PDO::FETCH_ASSOC)) {
    $final_cbrno =  $result['bc_code'];
  }

  echo $final_cbrno;

  die();
}
