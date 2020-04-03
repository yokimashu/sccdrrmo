<?php 
	include ('../config/db_config.php');
  session_start();
  
	if(isset($_POST['id'])){
    
		$id = $_POST['id'];
		$get_id_sql = "SELECT * FROM tbl_announcement WHERE objid = :id";
    $get_id_data = $con->prepare($get_id_sql);
    $get_id_data->execute([':id'=>$id]);
    while ($result2 = $get_id_data->fetch(PDO::FETCH_ASSOC)) {

  $id      = $result2['id'];
  $title  = $result2['title'];
  $author     = $result2['author'];
  $postdate     = $result2['postdate'];
  $image     = $result2['image'];
  $content     = $result2['content'];
  $status     = $result2['status'];
  $tag     = $result2['tag'];
  
}

$row = array(
  'id'         => $id,
  'title'      => $title,
  'author'     => $author,
  'postdate'   => $postdate,
  'image'      => $image,
  'content'    => $content,
  'status'     => $status,
  'tag'        => $tag,
);
    echo json_encode($row);
    
	}
?>