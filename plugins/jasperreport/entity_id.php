<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("PHPJasperXML.inc.php");



$server = 'localhost';
$user = 'root';
$pass = '1234';
$db = 'sccdrrmo';

$entity = $_GET['entity_no'];

$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("entity_id.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->sql = "SELECT entity_no from tbl_individual  where entity_no ='TYVOJR1413'";
$PHPJasperXML->transferDBtoArray($server, $user, $pass, $db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file

?>