<?php 
	include ('../config/db_config.php');
  session_start();
  
	if(isset($_POST['id'])){
    
		$id = $_POST['id'];
		$get_id_sql = "SELECT * FROM tbl_announcement WHERE id = :id";
    $get_id_data = $con->prepare($get_id_sql);
    $get_id_data->execute([':id'=>$id]);
    while ($result2 = $get_id_data->fetch(PDO::FETCH_ASSOC)) {

  $id       = $result2['id'];
  $title    = $result2['title'];
  $author   = $result2['author'];
  $status   = $result2['status'];
  
}

$row = array(
  'id'         => $id,
  'title'      => $title,
  'author'     => $author,
  'status'     => $status,
);
    echo json_encode($row);
    
	}
?>