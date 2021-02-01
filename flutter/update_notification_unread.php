<?php

include "dbconfig.php";

$objid = $_POST['objid'];
$status = 'READ';

$sql_statement = "UPDATE tbl_notification SET 

    status            = :status

    WHERE objid       = :objid

";

$sql_data = $con->prepare($sql_statement);
$sql_data->execute([

    ':status'          => $status,
    ':objid'           => $objid


]);

echo json_encode('Success');
