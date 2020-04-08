<?php

//fetch_comment.php

include ('../config/db_config.php');
session_start();

//only show delete button to session user
$btndelete ="";
$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0'
AND post_id = :post_id
ORDER BY comment_id DESC
";
$statement = $con->prepare($query);
$post = $_SESSION['post_id'];
$sender_id = $_SESSION['id'];
$statement->execute([':post_id' => $post]);

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
    if($sender_id == $row["comment_sender_id"]){$btndelete =" ";}else{$btndelete ="hidden";};
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading"><b>'.$row["comment_sender_name"].'</b><i class="badge"><i class="fa fa-clock-o"></i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right">
    <button '.$btndelete.' type="button" class="btn btn-sm btn-default delete" id="'.$row["comment_id"].'"><i class="fa fa-trash"></i></button>
    <button type="button" class="btn btn-sm btn-default reply" id="'.$row["comment_id"].'"><i class="fa fa-reply"></i></button>
  </div>
 </div>
 ';
 $output .= get_reply_comment($con, $row["comment_id"]);
}

echo $output;

function get_reply_comment($con, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $con->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
    $sender_id = $_SESSION['id'];
  foreach($result as $row)
  {
    if($sender_id == $row["comment_sender_id"]){$btndelete =" ";}else{$btndelete ="hidden";};
   $output .= '
   <div class="panel panel-default comment-reply" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading"><b>'.$row["comment_sender_name"].'</b><i class="badge"><i class="fa fa-clock-o"></i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right">
     <button '.$btndelete.' type="button" class="btn btn-sm btn-default delete" id="'.$row["comment_id"].'"><i class="fa fa-trash"></i></button>
     <button type="button" class="btn btn-sm btn-default reply" id="'.$row["comment_id"].'"><i class="fa fa-reply"></i></button>
     
    </div>
   </div>
   ';
   $output .= get_reply_comment($con, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}

?>
