<?php

include "dbconfig.php";

$username = $_POST['username'];

$sql = "SELECT * FROM tbl_entity where username  = :username";
$sqlExecute = $con->prepare($sql);
$sqlExecute->execute([':username' => $username]);
if ($sqlExecute->rowCount() > 0) {
    while ($result = $sqlExecute->fetch(PDO::FETCH_ASSOC)) {

        $type = $result['type'];
        $entity_no = $result['entity_no'];

        switch ($type) {

            case "INDIVIDUAL":
                //retrieve data from individual and enitity
                $get_sql = "SELECT * FROM tbl_individual i INNER JOIN tbl_entity e ON e.entity_no = i.entity_no  WHERE e.entity_no = :entity_no";
                $get_sql_data = $con->prepare($get_sql);
                $get_sql_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_sql_data->fetch(PDO::FETCH_ASSOC)) {
                    $mobileNo = $result2['mobile_no'];
                }
                echo json_encode($mobileNo);
                break;

            case "JURIDICAL":
                //retrieve data from juridical and enitity
                $get_sql = "SELECT * FROM tbl_juridical j INNER JOIN tbl_entity e ON e.entity_no = j.entity_no  WHERE e.entity_no = :entity_no";
                $get_sql_data = $con->prepare($get_sql);
                $get_sql_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_sql_data->fetch(PDO::FETCH_ASSOC)) {
                    $mobileNo = $result2['mobile_no'];
                }
                echo json_encode($mobileNo);
                break;

            case "LAND TRANSPORTATION":
                //retrieve data from land transportation and enitity
                $get_sql = "SELECT * FROM tbl_landtranspo l INNER JOIN tbl_entity e ON e.entity_no = l.entity_no  WHERE e.entity_no = :entity_no";
                $get_sql_data = $con->prepare($get_sql);
                $get_sql_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_sql_data->fetch(PDO::FETCH_ASSOC)) {
                    $mobileNo = $result2['mobile_no'];
                }
                echo json_encode($mobileNo);
                break;

            case "SEA TRANSPORTATION":
                //retrieve data from sea transportation and enitity
                $get_sql = "SELECT * FROM tbl_seatranspo s INNER JOIN tbl_entity e ON e.entity_no = s.entity_no  WHERE e.entity_no = :entity_no";
                $get_sql_data = $con->prepare($get_sql);
                $get_sql_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_sql_data->fetch(PDO::FETCH_ASSOC)) {
                    $mobileNo = $result2['mobile_no'];
                }
                echo json_encode($mobileNo);

                break;
            default:
                echo json_encode('Entity type is unknown!');
        }
    }
} else {
    echo json_encode('Username is not registered!');
}
