<?php

include('../config/db_config.php');


function generateEntityID(){
global $entity_no;

$template = 'XXXXXX9999';
$k = strlen($template);
$sernum ='';
for ($i=0; $i<$k; $i++)
  {
    switch($template[$i])
    {
      case 'X': $sernum .= chr(rand(65,90)); break;
      case '9': $sernum .= rand(0,9); break;
      case '-': $sernum .= '-'; break;
    }
  }
  $entity_no = $sernum;
  //echo $entity_no;
  checkEntityID();
}

function checkEntityID(){

  global $con;
  global $entity_no;

  $check_entity_sql = "SELECT * FROM tbl_entity where entity_no = :entity";
  $check_entity_data = $con->prepare($check_entity_sql);
  $check_entity_data->execute([':entity' => $entity_no]);

  $entity_count = $check_entity_data->rowCount();

    if ($entity_count == 0){
      echo $entity_no;

    }else{

      generateEntityID();
    }
}

    generateEntityID();

    die();

?>


