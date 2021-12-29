<?php

include "dbconfig.php";

$feed_id = $_POST['feed_id'];

$sql_comment = "SELECT * FROM tbl_comment c INNER JOIN tbl_individual i ON c.cmt_entityID = i.entity_no  WHERE c.status != 'deleted' AND c.feed_id = :feed_id ORDER BY c.date ASC";
$get_sql_comment = $con->prepare($sql_comment);
$get_sql_comment->execute([':feed_id' => $feed_id]);
$results = $get_sql_comment->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>
