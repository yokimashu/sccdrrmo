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


$entity_no = $_GET['entity_no'];
// $date_from =   date('Y-m-d', strtotime($_GET['datefrom']));
// $date_to =  date('Y-m-d', strtotime($_GET['dateto']));
$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("vaccination_card_preview.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT v.entity_no, SUBSTRING(civilstatus, 4) AS civilstatus,fullname,v.lastname, v.firstname, v.middlename, suffix,gender,t.barangay,age, full_address,city,t.province, contact_no, birthdate_, PhilHealthID, category,photo,email,
(SELECT username FROM tbl_entity WHERE entity_no = '". $entity_no ."') AS username,
(SELECT IFNULL((SELECT DateVaccination FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."'),'')) AS datevaccination1, 
(SELECT IFNULL((SELECT VaccineManufacturer FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."'),'')) AS VaccineManufacturer1,
(SELECT IFNULL((SELECT BatchNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."'),'')) AS BatchNumber1,
(SELECT IFNULL((SELECT LotNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."'),'')) AS LotNumber1,
(SELECT IFNULL((SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."'),'')) AS VaccinatorName1, (SELECT DateVaccination FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS datevaccination2, 
(SELECT VaccineManufacturer FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS VaccineManufacturer2,
(SELECT BatchNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS BatchNumber2,
(SELECT LotNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS LotNumber2,
(SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS VaccinatorName2,
(SELECT DISTINCT(bakuna_center) FROM tbl_assessment WHERE entity_no = '". $entity_no ."') AS bakunacenter,
(SELECT DISTINCT(bakuna_center_no) FROM tbl_assessment WHERE entity_no = '". $entity_no ."') AS bakunacenter_no,
(SELECT IFNULL((SELECT DISTINCT(signature) FROM tbl_vaccinators WHERE CONCAT(l_name, ', ', f_name, ' ', m_name) = (SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."')),'blank.png')) AS 1st_dose_signature,
(SELECT DISTINCT(signature) FROM tbl_vaccinators WHERE CONCAT(l_name, ', ', f_name, ' ', m_name) = (SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."')) AS 2nd_dose_signature

FROM tbl_vaccine v inner join tbl_individual t on t.entity_no = v.entity_no inner join tbl_assessment g on g.entity_no = v.entity_no  WHERE v.entity_no = '". $entity_no ."'";

// (SELECT (YEAR(CURRENT_TIMESTAMP) - YEAR(birthdate))  FROM tbl_individual WHERE entity_no = '". $entity_no ."') AS age
$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>