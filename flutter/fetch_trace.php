<?php

include "dbconfig.php";

$entity_no = $_POST['trace_no'];

$traceNoSQL = "SELECT * FROM tbl_entity where entity_no  = :entity_no";
$traceNoSQLExecute = $con->prepare($traceNoSQL);
$traceNoSQLExecute->execute([':entity_no' => $entity_no]);
if ($traceNoSQLExecute->rowCount() > 0) {
    while ($result = $traceNoSQLExecute->fetch(PDO::FETCH_ASSOC)) {

        $type = $result['type'];

        switch ($type) {

            case "INDIVIDUAL":
                //retrieve data from individual and enitity
                $get_individual_sql = "SELECT * FROM tbl_individual i INNER JOIN tbl_entity e ON e.entity_no = i.entity_no  WHERE e.entity_no = :entity_no";
                $get_individual_data = $con->prepare($get_individual_sql);
                $get_individual_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                    $all = $result2;
                }
                echo json_encode($all);
                break;

            case "JURIDICAL":
                //retrieve data from juridical and enitity
                $get_individual_sql = "SELECT * FROM tbl_juridical j INNER JOIN tbl_entity e ON e.entity_no = j.entity_no  WHERE e.entity_no = :entity_no";
                $get_individual_data = $con->prepare($get_individual_sql);
                $get_individual_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                    $all = $result2;
                }
                echo json_encode($all);
                break;

            case "LAND TRANSPORTATION":
                //retrieve data from land transportation and enitity
                $get_individual_sql = "SELECT * FROM tbl_landtranspo l INNER JOIN tbl_entity e ON e.entity_no = l.entity_no  WHERE e.entity_no = :entity_no";
                $get_individual_data = $con->prepare($get_individual_sql);
                $get_individual_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                    $all = $result2;
                }
                echo json_encode($all);
                break;

            case "SEA TRANSPORTATION":
                //retrieve data from sea transportation and enitity
                $get_individual_sql = "SELECT * FROM tbl_seatranspo s INNER JOIN tbl_entity e ON e.entity_no = s.entity_no  WHERE e.entity_no = :entity_no";
                $get_individual_data = $con->prepare($get_individual_sql);
                $get_individual_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                    $all = $result2;
                }
                echo json_encode($all);

                break;
            default:
                echo json_encode('Entity type is unknown!');
        }
    }
} else {
    echo json_encode('QR Code is not registered!');
}
