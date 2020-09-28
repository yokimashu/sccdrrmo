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
        //fetch entity number
        $entity_no = $result['entity_no'];

        //fetch status number
        $status = $result['status'];

        //from database already hash
        $hash_password = $result['password'];

        //hash the $u_pass and compared to $hashed_password
        if (password_verify($password, $hash_password)) {

            //retrieve data from individual
            $get_individual_sql = "SELECT * FROM tbl_individual i INNER JOIN tbl_entity e ON e.entity_no = i.entity_no  WHERE e.entity_no = :entity_no";
            $get_individual_data = $con->prepare($get_individual_sql);
            $get_individual_data->execute([':entity_no' => $entity_no]);

            // $result = $get_individual_data->fetchAll(PDO::FETCH_ASSOC);
            while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                $all = $result2;
            }
            if ($status != 'ACTIVE') {
                // --- if user is not active

                echo json_encode('Your account is not activated!');
            } else {
                // --- if user is active
                echo json_encode($all);
            }
        } else {
            // --- if password is incorrect
            echo json_encode('Password Incorrect!');
        }
    }
} else {
    // --- if username is not registered
    echo json_encode('Username is not registered!');
}
