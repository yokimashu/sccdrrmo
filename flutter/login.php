<?php

include "dbconfig.php";

$username = $_POST['username'];
$password = $_POST['password'];

// check if username is registered
$check_username_sql = "SELECT * FROM tbl_entity where username = :username";
$username_data = $con->prepare($check_username_sql);
$username_data->execute([':username' => $username]);
if ($username_data->rowCount() > 0) {

    while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {

        $entity_no = $result['entity_no'];
        $status = $result['status'];
        $type = $result['type'];
        $hash_password = $result['password'];

        //hash the $u_pass and compared to $hashed_password
        if (password_verify($password, $hash_password)) {

            if ($status == 'ACTIVE') {

                if ($type == 'INDIVIDUAL') {

                    //retrieve data from individual and enitity
                    $get_individual_sql = "SELECT * FROM tbl_individual i INNER JOIN tbl_entity e ON e.entity_no = i.entity_no  WHERE e.entity_no = :entity_no";
                    $get_individual_data = $con->prepare($get_individual_sql);
                    $get_individual_data->execute([':entity_no' => $entity_no]);
                    while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                        $all = $result2;
                    }
                    echo json_encode($all);

                } elseif ($type == 'JURIDICAL') {
                    
                    //retrieve data from juridical and enitity
                    $get_individual_sql = "SELECT * FROM tbl_juridical j INNER JOIN tbl_entity e ON e.entity_no = j.entity_no  WHERE e.entity_no = :entity_no";
                    $get_individual_data = $con->prepare($get_individual_sql);
                    $get_individual_data->execute([':entity_no' => $entity_no]);
                    while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                        $all = $result2;
                    }
                    echo json_encode($all);
                    
                } elseif ($type == 'LAND TRANSPORTATION') {
                    
                    //retrieve data from land transportation and enitity
                    $get_individual_sql = "SELECT * FROM tbl_landtranspo l INNER JOIN tbl_entity e ON e.entity_no = l.entity_no  WHERE e.entity_no = :entity_no";
                    $get_individual_data = $con->prepare($get_individual_sql);
                    $get_individual_data->execute([':entity_no' => $entity_no]);
                    while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                        $all = $result2;
                    }
                    echo json_encode($all);
                    
                } elseif ($type == 'SEA TRANSPORTATION') {
                    
                    //retrieve data from sea transportation and enitity
                    $get_individual_sql = "SELECT * FROM tbl_seatranspo s INNER JOIN tbl_entity e ON e.entity_no = s.entity_no  WHERE e.entity_no = :entity_no";
                    $get_individual_data = $con->prepare($get_individual_sql);
                    $get_individual_data->execute([':entity_no' => $entity_no]);
                    while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                        $all = $result2;
                    }
                    echo json_encode($all);
                    
                }
            } else {

                echo json_encode('Your account is not activated!');
            }
        } else {

            echo json_encode('Password Incorrect!');
        }
    }
} else {

    echo json_encode('Username is not registered!');
}
