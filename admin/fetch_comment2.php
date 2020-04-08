<?php 

  // this is for delete and reply

	include ('../config/db_config.php');
  session_start();
  
	if(isset($_POST['id'])){
    
		$id = $_POST['id'];
		$get_id_sql = "SELECT * FROM tbl_comment WHERE comment_id = :id";
    $get_id_data = $con->prepare($get_id_sql);
    $get_id_data->execute([':id'=>$id]);
    while ($result2 = $get_id_data->fetch(PDO::FETCH_ASSOC)) {

  $id = $result2['comment_id'];
  $csn = "Reply to  <b>".$result2['comment_sender_name']." </b>";
  
}

$row = array(

  'csn'  => $csn,
  'id'   => $id,

);
    echo json_encode($row);
    
	}
?>