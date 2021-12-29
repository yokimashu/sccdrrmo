<?php

include "dbconfig.php";

$comment_id = $_POST["comment_id"];


$status = 'deleted';

$sql_statement = "UPDATE tbl_comment SET 

    status               = :status

    WHERE comment_id     = :comment_id

";

$sql_data = $con->prepare($sql_statement);
$sql_data->execute([

    ':status'            => $status,
    ':comment_id'        => $comment_id


]);

echo json_encode($comment_id . ' has been deleted!');
