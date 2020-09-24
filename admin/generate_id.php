<?php

include('../config/db_config.php');

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

  $docno = $sernum;


  echo $docno;


die();

?>


