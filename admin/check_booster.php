<?php 

include('../config/db_config.php');
$entity_no = $_POST['entity_no'];
$get_vaccine_status= 'VALIDATED';
$get_booster ="SELECT 1stDose,2ndDose,3rdDose
FROM tbl_assessment WHERE datevaccination <= DATE_SUB(NOW(), INTERVAL 3 MONTH) AND entity_no=:entity
ORDER BY objid DESC LIMIT 1";

$create_stmt = $con->prepare($get_booster);
$create_stmt->execute([':entity' =>$entity_no]);
if ($create_stmt->rowCount() > 0) {
while ($result = $create_stmt->fetch(PDO::FETCH_ASSOC)) {
   
        $first = $result['1stDose'];
        $second = $result['2ndDose'];
        $third = $result['3rdDose'];
        if ($first == '01_Yes' && $second == '02_No') {
            $get_vaccine_status= 'CANDIDATE FOR 2ND DOSE';
        }
        if ($first == '01_Yes' && $second == '01_Yes' && $third =='02_No') {
            $get_vaccine_status= 'CANDIDATE FOR BOOSTER SHOT';
        }
        if ($first == '01_Yes' && $second == '01_Yes' && $third =='01_Yes') {
            $get_vaccine_status= 'FULLY VACCINATED';
        }
    }

} 
json_encode($get_vaccine_status);

?>