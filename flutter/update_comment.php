<?php

include "dbconfig.php";

$comment_id = $_POST["comment_id"];
$comment = $_POST["comment"];

$status = 'edited';

$sql_statement = "UPDATE tbl_comment SET 

    comment              = :comment,
    status               = :status

    WHERE comment_id     = :comment_id

";

$sql_data = $con->prepare($sql_statement);
$sql_data->execute([

    ':comment'           => $comment,
    ':status'            => $status,
    ':comment_id'        => $comment_id

]);

echo json_encode($comment_id . ' has been updated!');
