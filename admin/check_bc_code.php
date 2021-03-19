<?php


session_start();

include('../config/db_config.php');

if (isset($_POST['bc_code'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";


$bc_code = $_POST['bc_code'];

$check_bc_code_sql = "SELECT * FROM tbl_bakuna_center where bc_code = :bc_code";
        
$check_bc_code_data = $con->prepare($check_bc_code_sql);
$check_bc_code_data ->execute([
  ':bc_code' => $bc_code
]);

if ($check_bc_code_data->rowCount() > 0){

  echo '<div style="color: red;"> <b>'.$bc_code.'</b> is already in use! </div>';
  }else{
  echo '<div style="color: green;"> <b>'.$bc_code.'</b> is avaialable! </div>';
  }

die();

}


