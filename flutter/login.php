<?php

include "dbconfig.php";

$username = $_POST['username'];
$password = $_POST['password'];
$token = $_POST['token'];

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

            if ($token != null) { // update user's token
                $sql_statement = "UPDATE tbl_entity SET 
                    token               = :token
                    WHERE entity_no     = :entity_no
                ";

                $sql_data = $con->prepare($sql_statement);
                $sql_data->execute([
                    ':token'            => $token,
                    ':entity_no'        => $entity_no
                ]);
            }



            // -------------------------------------- INDIVIDUAL -------------------------------------- //
            if ($type == 'INDIVIDUAL') {

                $user_vaccine =

                    "SELECT t.entity_no, e.status, e.type, t.date_register, t.firstname, t.middlename, t.lastname, t.fullname, SUBSTRING(v.civilstatus, 4) AS civilstatus, t.mobile_no, t.telephone_no, t.email, t.gender, t.birthdate, t.street, t.barangay, t.city, t.province, t.photo,
                    (SELECT DateVaccination FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '" . $entity_no . "') AS datevaccination1, 
                    (SELECT VaccineManufacturer FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '" . $entity_no . "') AS VaccineManufacturer1,
                    (SELECT BatchNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '" . $entity_no . "') AS BatchNumber1,
                    (SELECT LotNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '" . $entity_no . "') AS LotNumber1,
                    (SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '" . $entity_no . "') AS VaccinatorName1, 
                    (SELECT DateVaccination FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '" . $entity_no . "') AS datevaccination2, 
                    (SELECT VaccineManufacturer FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '" . $entity_no . "') AS VaccineManufacturer2,
                    (SELECT BatchNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '" . $entity_no . "') AS BatchNumber2,
                    (SELECT LotNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '" . $entity_no . "') AS LotNumber2,
                    (SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '" . $entity_no . "') AS VaccinatorName2,
                   
                    (SELECT CASE 2nddose WHEN 2ndDose = '01_Yes' THEN 'Fully Vaccinated' WHEN '02_No' THEN 'Partially Vaccinated' END VaccineStatus FROM tbl_assessment WHERE entity_no = '" . $entity_no . "' AND DateVaccination = (SELECT MAX(DateVaccination) FROM tbl_assessment WHERE entity_no = '" . $entity_no . "' AND status = 'VACCINATED')) AS VaccineStatus
                   
                    FROM tbl_vaccine v 
                    INNER JOIN tbl_individual t ON t.entity_no = v.entity_no
                    INNER JOIN tbl_entity e ON e.entity_no = v.entity_no
                    WHERE v.entity_no = '" . $entity_no . "'";

                $get_user_vaccine = $con->prepare($user_vaccine);
                $get_user_vaccine->execute([':entity_no' => $entity_no]);

                // check if user has table vaccine
                if ($get_user_vaccine->rowCount() > 0) {
                    // if true 
                    // set API
                    while ($result2 = $get_user_vaccine->fetch(PDO::FETCH_ASSOC)) {
                        $all = $result2;
                    };
                } else {
                    // if false
                    // execute basic data
                    $get_individual_sql = "SELECT * FROM tbl_individual i INNER JOIN tbl_entity e ON e.entity_no = i.entity_no  WHERE e.entity_no = :entity_no";
                    $get_individual_data = $con->prepare($get_individual_sql);
                    $get_individual_data->execute([':entity_no' => $entity_no]);
                    while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                        $all = $result2;
                    }
                }

                // send to API
                echo json_encode($all);
                //


                // -------------------------------------- JURIDICAL -------------------------------------- //
            } elseif ($type == 'JURIDICAL') {

                //retrieve data from juridical and enitity
                $get_individual_sql = "SELECT * FROM tbl_juridical j INNER JOIN tbl_entity e ON e.entity_no = j.entity_no  WHERE e.entity_no = :entity_no";
                $get_individual_data = $con->prepare($get_individual_sql);
                $get_individual_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                    $all = $result2;
                }
                echo json_encode($all);
                //


                // -------------------------------------- LAND TRANSPORTATION -------------------------------------- //
            } elseif ($type == 'LAND TRANSPORTATION') {

                //retrieve data from land transportation and enitity
                $get_individual_sql = "SELECT * FROM tbl_landtranspo l INNER JOIN tbl_entity e ON e.entity_no = l.entity_no  WHERE e.entity_no = :entity_no";
                $get_individual_data = $con->prepare($get_individual_sql);
                $get_individual_data->execute([':entity_no' => $entity_no]);
                while ($result2 = $get_individual_data->fetch(PDO::FETCH_ASSOC)) {
                    $all = $result2;
                }
                echo json_encode($all);
                //


                // -------------------------------------- SEA TRANSPORATION -------------------------------------- //
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

            echo json_encode('Password Incorrect!');
        }
    }
} else {

    echo json_encode('Username is not registered!');
}
