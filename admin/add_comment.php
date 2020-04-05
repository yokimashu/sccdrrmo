<?php

//add_comment.php

include ('../config/db_config.php');
session_start();

$error = '';
$comment_content = '';
$comment_name = $_POST["comment_name"];
$comment_sender_id = $_SESSION['id'];

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
 INSERT INTO tbl_comment 
 (post_id, parent_comment_id, comment, comment_sender_id, comment_sender_name) 
 VALUES (:post_id, :parent_comment_id, :comment, :comment_sender_id,:comment_sender_name)
 ";
 $statement = $con->prepare($query);
 $statement->execute(
  array(
   ':post_id' => $_POST["comment_post_id"],
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':comment_sender_id' => $comment_sender_id,
   ':comment_sender_name' => $comment_name
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
