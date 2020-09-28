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
        //from database already hash
        $hash_password = $result['password'];

        //hash the $u_pass and compared to $hashed_password
        if (password_verify($password, $hash_password)) {

            //retrieve data from individual
            $get_incident_sql = "SELECT * FROM tbl_individual WHERE entity_no = :entity_no";
            $get_incident_data = $con->prepare($get_incident_sql);
            $get_incident_data->execute([':entity_no' => $entity_no]);
            while ($result2 = $get_incident_data->fetch(PDO::FETCH_ASSOC)) {
                $firstname      = $result2['firstname'];
                $middlename     = $result2['middlename'];
                $lastname       = $result2['lastname'];
            };

            if ($result['status'] != "ACTIVE") {
                echo json_encode('Your account is not activated!');
            }else{
                
            }
        } else {
            echo json_encode('Password Incorrect!');
        }
    }
} else {
    echo json_encode('Username is not registered!');
}
