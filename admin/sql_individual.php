<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';

$get_all_individual_sql = "SELECT entity_no,fullname,street,barangay,photo FROM tbl_individual ";
$get_all_individual_data = $con->prepare($get_all_individual_sql);
$get_all_individual_data->execute();




