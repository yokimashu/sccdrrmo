<?php

include "dbconfig.php";

$entity_no = $_POST['entity_no'];
// SAKZIC2138
// HZJJPZ1670

//retrieve data from individual and enitity and vaccine
$user_vaccine =

"SELECT t.entity_no, 
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

echo json_encode($all);
