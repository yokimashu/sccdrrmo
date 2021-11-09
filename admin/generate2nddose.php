<?php

require_once '../admin/SimpleXLSXGen.php';
include("../config/db_config.php");
$date_format = date('Y-m-d');
$file_name = 'Sinovac-'.$date_format. '.xlsx';
$data2 = [[
    "2nd Dose Schedule","Entity No","Category","Last Name","First Name","Middle Name","Suffix","Barangay","Sex","BirthDate","Contact No","Bakuna Center"
]];
$seconddose = "SELECT DATE_ADD(a.`DateVaccination`, INTERVAL 28 DAY)  AS 2ndDoseSchedule, a.entity_no, category, lastname, firstname, middlename, suffix, 
barangay, sex, birthdate_, contact_no, bakuna_center 
FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no  WHERE a.entity_no NOT IN
(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') AND a.status = 'VACCINATED' AND a.`VaccineManufacturer` = 'Sinovac'
ORDER BY 2ndDoseSchedule ASC";

$prep_stmt_download2 = $con->prepare($seconddose);
$prep_stmt_download2->execute();

while ($get_download_data2 = $prep_stmt_download2->fetch(PDO::FETCH_ASSOC)){      
    $nestedData2=array();
    $nestedData2[] = $get_download_data2["2ndDoseSchedule"];
    $nestedData2[] = $get_download_data2["entity_no"];
    $nestedData2[] = $get_download_data2["category"];
    $nestedData2[] = $get_download_data2["lastname"];
    $nestedData2[] = $get_download_data2["firstname"];
    $nestedData2[] = $get_download_data2["middlename"];
    $nestedData2[] = $get_download_data2["suffix"];
    $nestedData2[] = $get_download_data2["barangay"];
    $nestedData2[] = $get_download_data2["sex"];
    $nestedData2[] = $get_download_data2["birthdate_"];
    $nestedData2[] = $get_download_data2["contact_no"];
    $nestedData2[] = $get_download_data2["bakuna_center"];


   

    $data2[] = $nestedData2;
}

SimpleXLSXGen::fromArray($data2)->downloadAs($file_name);

header('location :vaccine_dashboard.php');
?>