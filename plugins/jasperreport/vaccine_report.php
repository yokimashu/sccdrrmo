<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("PHPJasperXML.inc.php");



// $server = 'http://localhost:8888';
// $user = 'root';
// $pass = '1234';
// $db = 'sccdrrmo';


$host = "127.0.0.1";
$db_name = "sccdrrmo";
$username = "root";
$password = "I0nvNUWNXoYI";

// $host = "localhost";
// $db_name = "sccdrrmo";
// $username = "root";
// $password = "";

$date_from =   date('Y-m-d', strtotime($_GET['datefrom']));
$date_to =   date('Y-m-d', strtotime($_GET['dateto']));

$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("vaccine_report.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT DATE_FORMAT(a.DateVaccination,'%M %d, %Y') AS datevaccination,

(SELECT SUM(Category = 'A1') FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A1,
(SELECT SUM(Category = 'A1.8') FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A1_8,
(SELECT SUM(Category = 'A1.9')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A1_9,
(SELECT SUM(Category = 'Additional A1'  )FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS Additional_A1,
(SELECT SUM(Category = 'A2')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A2,
(SELECT SUM(Category = 'A3')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A3,
(SELECT SUM(Category = 'Expanded A3' )FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS Expanded_A3,
(SELECT SUM(Category = 'Pediatric A3' )FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS Pediatric_A3,
(SELECT SUM(Category = 'A4')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A4,
(SELECT SUM(Category = 'A5')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS A5,
(SELECT SUM(Category = 'ROAP')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS ROAP,
(SELECT SUM(Category = 'ROPP')FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."') AS ROPP,



SUM(Category = 'A1'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS TOTAL_A1,
SUM(Category = 'A1.8'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_A1_8,
SUM(Category = 'A1.9'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_A1_9,
SUM(Category = 'Additional A1'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_A1_9,
SUM(Category = 'A2'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_A2,
SUM(Category = 'A3'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_A3,
SUM(Category = 'Expanded A3'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_EXPANDED_A3,
SUM(Category = 'Pediatric A3' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS TOTAL_PEDIATRIC_A3,
SUM(Category = 'A4'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_A4,
SUM(Category = 'A5' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS TOTAL_A5,
SUM(Category = 'ROAP'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' ) THEN 1 ELSE 0 END) AS TOTAL_ROAP,
SUM(Category = 'ROPP' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS TOTAL_ROPP,


SUM(Category = 'A1' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 01_A1_1st_TOTAL_Sinovac,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 02_A1_8_1st_TOTAL_Sinovac,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 03_A1_9_1st_TOTAL_Sinovac,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 04_ADDITIONAL_A1_TOTAL_Sinovac,
SUM(Category = 'A2' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 05_A2_1st_TOTAL_Sinovac,
SUM(Category = 'A3' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 06_A3_1st_TOTAL_Sinovac,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 07_EXPANDED_A3_1st_TOTAL_Sinovac,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 08_PEDIATRIC_A3_1st_TOTAL_Sinovac,
SUM(Category = 'A4' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 09_A4_1st_TOTAL_Sinovac,
SUM(Category = 'A5' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 10_A5_1st_TOTAL_Sinovac,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 11_ROAP_1st_TOTAL_Sinovac,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 12_ROPP_1st_TOTAL_Sinovac,


SUM(Category = 'A1' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_TOTAL_Sinovac,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A1_8_2nd_TOTAL_Sinovac,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A1_9_2nd_TOTAL_Sinovac,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_2nd_ADDITIONAL_A1_TOTAL_Sinovac,
SUM(Category = 'A2' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A2_2nd_TOTAL_Sinovac,
SUM(Category = 'A3' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 06_A3_2nd_TOTAL_Sinovac,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 07_EXPANDED_A3_2nd_TOTAL_Sinovac,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 08_PEDIATRIC_A3_2nd_TOTAL_Sinovac,
SUM(Category = 'A4' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 09_A4_2nd_TOTAL_Sinovac,
SUM(Category = 'A5' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 10_A5_2nd_TOTAL_Sinovac,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 11_ROAP_2nd_TOTAL_Sinovac,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 12_ROPP_2nd_TOTAL_Sinovac,


SUM(Category = 'A1' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 01_A1_1st_TOTAL_Astra,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 02_A1_8_1st_TOTAL_Astra,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 03_A1_9_1st_TOTAL_Astra,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 04_ADDITIONAL_A1_TOTAL_Astra,
SUM(Category = 'A2' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 05_A2_1st_TOTAL_Astra,
SUM(Category = 'A3' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 06_A3_1st_TOTAL_Astra,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 07_EXPANDED_A3_1st_TOTAL_Astra,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 08_PEDIATRIC_A3_1st_TOTAL_Astra,
SUM(Category = 'A4' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 09_A4_1st_TOTAL_Astra,
SUM(Category = 'A5' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 10_A5_1st_TOTAL_Astra,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 11_ROAP_1st_TOTAL_Astra,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 12_ROPP_1st_TOTAL_Astra,


SUM(Category = 'A1' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_TOTAL_Astra,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A1_8_2nd_TOTAL_Astra,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A1_9_2nd_TOTAL_Astra,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_ADDITIONAL_A1_2nd_TOTAL_Astra,
SUM(Category = 'A2' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A2_2nd_TOTAL_Astra,
SUM(Category = 'A3' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 06_A3_2nd_TOTAL_Astra,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 07_EXPANDED_A3_2nd_TOTAL_Astra,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 08_PEDIATRIC_A3_2nd_TOTAL_Astra,
SUM(Category = 'A4' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 09_A4_2nd_TOTAL_Astra,
SUM(Category = 'A5' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 10_A5_2nd_TOTAL_Astra,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 11_ROAP_2nd_TOTAL_Astra,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 12_ROPP_2nd_TOTAL_Astra,


SUM(Category = 'A1' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_1st_TOTAL_Janssen,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A1_8_1st_TOTAL_Janssen,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A1_9_1st_TOTAL_Janssen,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_ADDITIONAL_A1_TOTAL_Janssen,
SUM(Category = 'A2' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A2_1st_TOTAL_Janssen,
SUM(Category = 'A3' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 06_A3_1st_TOTAL_Janssen,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 07_EXPANDED_A3_1st_TOTAL_Janssen,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 08_PEDIATRIC_A3_1st_TOTAL_Janssen,
SUM(Category = 'A4' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 09_A4_1st_TOTAL_Janssen,
SUM(Category = 'A5' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 10_A5_1st_TOTAL_Janssen,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 11_ROAP_1st_TOTAL_Janssen,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 12_ROPP_1st_TOTAL_Janssen,


SUM(Category = 'A1' AND VaccineManufacturer = 'Moderna' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 01_A1_1st_TOTAL_Moderna,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 02_A1_8_1st_TOTAL_Moderna,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 03_A1_9_1st_TOTAL_Moderna,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 04_ADDITIONAL_A1_TOTAL_Moderna,
SUM(Category = 'A2' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 05_A2_1st_TOTAL_Moderna,
SUM(Category = 'A3' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 06_A3_1st_TOTAL_Moderna,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 07_EXPANDED_A3_1st_TOTAL_Moderna,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Moderna'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 08_PEDIATRIC_A3_1st_TOTAL_Moderna,
SUM(Category = 'A4' AND VaccineManufacturer = 'Moderna' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 09_A4_1st_TOTAL_Moderna,
SUM(Category = 'A5' AND VaccineManufacturer = 'Moderna' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 10_A5_1st_TOTAL_Moderna,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Moderna' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 11_ROAP_1st_TOTAL_Moderna,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Moderna' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 12_ROPP_1st_TOTAL_Moderna,


SUM(Category = 'A1' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_TOTAL_Moderna,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A1_8_2nd_TOTAL_Moderna,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A1_9_2nd_TOTAL_Moderna,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_ADDITIONAL_A1_2nd_TOTAL_Moderna,
SUM(Category = 'A2' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A2_2nd_TOTAL_Moderna,
SUM(Category = 'A3' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 06_A3_2nd_TOTAL_Moderna,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 07_EXPANDED_A3_2nd_TOTAL_Moderna,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 08_PEDIATRIC_A3_2nd_TOTAL_Moderna,
SUM(Category = 'A4' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 09_A4_2nd_TOTAL_Moderna,
SUM(Category = 'A5' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 10_A5_2nd_TOTAL_Moderna,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 11_ROAP_2nd_TOTAL_Moderna,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 12_ROPP_2nd_TOTAL_Moderna,


SUM(Category = 'A1' AND VaccineManufacturer = 'Pfizer' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 01_A1_1st_TOTAL_Pfizer,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 02_A1_8_1st_TOTAL_Pfizer,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 03_A1_9_1st_TOTAL_Pfizer,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 04_ADDITIONAL_A1_TOTAL_Pfizer,
SUM(Category = 'A2' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 05_A2_1st_TOTAL_Pfizer,
SUM(Category = 'A3' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 06_A3_1st_TOTAL_Pfizer,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 07_EXPANDED_A3_1st_TOTAL_Pfizer,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Pfizer'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 08_PEDIATRIC_A3_1st_TOTAL_Pfizer,
SUM(Category = 'A4' AND VaccineManufacturer = 'Pfizer' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 09_A4_1st_TOTAL_Pfizer,
SUM(Category = 'A5' AND VaccineManufacturer = 'Pfizer' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 10_A5_1st_TOTAL_Pfizer,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Pfizer' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 11_ROAP_1st_TOTAL_Pfizer,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Pfizer' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END) AS 12_ROPP_1st_TOTAL_Pfizer,


SUM(Category = 'A1' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_TOTAL_Pfizer,
SUM(Category = 'A1.8' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A1_8_2nd_TOTAL_Pfizer,
SUM(Category = 'A1.9' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A1_9_2nd_TOTAL_Pfizer,
SUM(Category = 'Additional A1' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_ADDITIONAL_A1_2nd_TOTAL_Pfizer,
SUM(Category = 'A2' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A2_2nd_TOTAL_Pfizer,
SUM(Category = 'A3' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 06_A3_2nd_TOTAL_Pfizer,
SUM(Category = 'Expanded A3' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 07_EXPANDED_A3_2nd_TOTAL_Pfizer,
SUM(Category = 'Pediatric A3' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 08_PEDIATRIC_A3_2nd_TOTAL_Pfizer,
SUM(Category = 'A4' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 09_A4_2nd_TOTAL_Pfizer,
SUM(Category = 'A5' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 10_A5_2nd_TOTAL_Pfizer,
SUM(Category = 'ROAP' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 11_ROAP_2nd_TOTAL_Pfizer,
SUM(Category = 'ROPP' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 12_ROPP_2nd_TOTAL_Pfizer,

 (SELECT SUM(Category = 'A1' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END 
 OR Category = 'A1' AND VaccineManufacturer = 'Sinovac' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes'
 OR Category = 'A1' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END
 OR Category = 'A1' AND VaccineManufacturer = 'Astrazeneca' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes'
 OR Category = 'A1' AND VaccineManufacturer = 'Janssen' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes'
 OR Category = 'A1' AND VaccineManufacturer = 'Moderna' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END
 OR Category = 'A1' AND VaccineManufacturer = 'Moderna' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes'
 OR Category = 'A1' AND VaccineManufacturer = 'Pfizer' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') THEN 1 ELSE 0 END
 OR Category = 'A1' AND VaccineManufacturer = 'Pfizer' AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes'
 ))
 AS A1_TOTAL

FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE (a.status = 'VACCINATED') AND a.DateVaccination  between '". $date_from ."' and '". $date_to ."';";

$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>