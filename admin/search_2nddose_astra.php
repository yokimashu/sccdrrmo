<?php
include('../config/db_config.php');
// $userDepartment = $_SESSION['department'];
// $filterBrgy =   '';
// if($_SESSION['user_type'] == 1){
//     $filterBrgy = '';
// }else{
//     $filterBrgy = "WHERE barangay = '".$userDepartment."'";
// }
// $columns= array( 
//     // datatable column index  => database column name
//         0 =>  'entity_no', 
//         1 => 'username',
//         2 => 'fullname',
//         3 => 'status',
    
//     );
    

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$getAllIndividual = "SELECT DATE_ADD(a.`DateVaccination`, INTERVAL 12 WEEK)  AS 2ndDoseSchedule, a.entity_no, category, SubPriority,CONCAT(Firstname,' ',Middlename,' ',Lastname) AS fullname, suffix, contact_no, region, province, muncity, 
barangay, sex, birthdate_, profession, allergy_08, W_comorbidities,1stDose, 2ndDose 
FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no  WHERE a.entity_no NOT IN
(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') AND a.status = 'VACCINATED' AND a.`VaccineManufacturer` = 'Astrazeneca' ORDER BY 2ndDoseSchedule ASC LIMIT ".$requestData['start']." ,".$requestData['length']." ";

$getIndividualData = $con->prepare($getAllIndividual);
$getIndividualData->execute();                   

$countNoFilter = "SELECT COUNT(entity_no) as id from tbl_assessment a WHERE a.entity_no NOT IN
(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') AND a.status = 'VACCINATED' AND a.`VaccineManufacturer` = 'Astrazeneca'";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_2nddose_astra.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;  
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT DATE_ADD(a.`DateVaccination`, INTERVAL 12 WEEK)  AS 2ndDoseSchedule, a.entity_no, category, SubPriority,CONCAT(Firstname,' ',Middlename,' ',Lastname) AS fullname, suffix, contact_no, region, province, muncity, 
barangay, sex, birthdate_, profession, allergy_08, W_comorbidities,1stDose, 2ndDose 
FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no  WHERE a.entity_no NOT IN
(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes') AND a.status = 'VACCINATED' AND a.`VaccineManufacturer` = 'Astrazeneca'  
";
             
     if( !empty($requestData['search']['value']) ) {
        $getAllIndividual.=" AND (Firstname LIKE '%".$requestData['search']['value']."%'";
        $getAllIndividual.=" OR a.entity_no LIKE '%".$requestData['search']['value']."%'";
        $getAllIndividual.=" OR CONCAT(Firstname,' ',Middlename,' ',Lastname) LIKE '%" . $requestData['search']['value'] ."%'";
        $getAllIndividual.=" OR CONCAT(Firstname,' ',Lastname) LIKE '%" . $requestData['search']['value'] . "%' ";
        $getAllIndividual.=" OR Middlename LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR Lastname LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR Barangay LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR Profession LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR Employer_name LIKE '%".$requestData['search']['value']."%') ";
        $getAllIndividual.=" ORDER BY 2ndDoseSchedule ASC LIMIT ".$requestData['start'].",".$requestData['length']." ";
        $getIndividualData = $con->prepare($getAllIndividual);
        $getIndividualData->execute(); 

     $countfilter = "SELECT COUNT(e.entity_no) as id from tbl_assessment e inner join tbl_vaccine i on e.entity_no = i.entity_no  where";
     $countfilter.=" (Firstname LIKE '%".$requestData['search']['value']."%'";
     $countfilter.=" OR e.entity_no LIKE '%".$requestData['search']['value']."%' ";
     $countfilter.=" OR CONCAT(Firstname,' ',Middlename,' ',Lastname) LIKE '%" . $requestData['search']['value'] . "%' ";
     $countfilter.=" OR CONCAT(Firstname,' ',Lastname) LIKE '%" . $requestData['search']['value'] . "%' ";
     $countfilter.=" OR Middlename LIKE '%".$requestData['search']['value']."%' ";
     $countfilter.=" OR Lastname LIKE '%".$requestData['search']['value']."%' ";
     $countfilter.=" OR Barangay LIKE '%".$requestData['search']['value']."%' ";
     $countfilter.=" OR Profession LIKE '%".$requestData['search']['value']."%' ";
     $countfilter.=" OR Employer_name LIKE '%".$requestData['search']['value']."%') ";
     $countfilter.="LIMIT ".$requestData['length']." " ;

        $getrecordstmt = $con->prepare($countfilter);
        $getrecordstmt->execute() or die("search_2nddose_astra.php");
        $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['id'];
        $totalFiltered = $totalData;
     }

     $data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["entity_no"];
    $nestedData[] = $row["fullname"];
    $nestedData[] = $row["contact_no"];
    $nestedData[] = $row["muncity"];
    $nestedData[] = $row["2ndDoseSchedule"];

	$data[] = $nestedData;
}
        $json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format


?>