<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once("../PHPJasperXML.inc.php");
include_once ('setting.php');
$phpjasperversion='1.1';

$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->load_xml_file("sample3.jrxml");
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
