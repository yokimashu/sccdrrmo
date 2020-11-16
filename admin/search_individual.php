<?php
include('../config/db_config.php');
session_start();
$userDepartment = $_SESSION['department'];
$filterBrgy =   '';
if($_SESSION['user_type'] == 1){
    $filterBrgy = '';
}else{
    $filterBrgy = "WHERE barangay = '".$userDepartment."'";
}
$columns= array( 
    // datatable column index  => database column name
        0 =>  'entity_no', 
        1 => 'username',
        2 => 'fullname',
    
    );
    

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$getAllIndividual = "SELECT e.entity_no,
                     username,
                     fullname FROM tbl_individual e 
                    inner join tbl_entity i on e.entity_no = i.entity_no ".$filterBrgy."
                     ORDER BY e.date_register DESC LIMIT ".$requestData['start']." ,".$requestData['length']."  ";

$getIndividualData = $con->prepare($getAllIndividual);
$getIndividualData->execute();                   

$countNoFilter = "SELECT COUNT(entity_no) as id from tbl_individual";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_individual.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;  
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT e.entity_no,
                    username, 
                    fullname 
                    from tbl_individual e 
                    inner join tbl_entity i on e.entity_no = i.entity_no where ";
             
     if( !empty($requestData['search']['value']) ) {
        $getAllIndividual.=" (e.firstname LIKE '%".$requestData['search']['value']."%'";
        $getAllIndividual.=" OR e.entity_no LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR street LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR e.city LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR province LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR mobile_no LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR telephone_no LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR email LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR username LIKE '%".$requestData['search']['value']."%') ";

        $getAllIndividual.=" ORDER BY date_register DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $getIndividualData = $con->prepare($getAllIndividual);
        $getIndividualData->execute(); 

        $countfilter = "SELECT COUNT(e.entity_no) as id from tbl_individual e inner join tbl_entity i on e.entity_no = i.entity_no  where";
       $countfilter.=" (firstname LIKE '%".$requestData['search']['value']."%'";
       $countfilter.=" OR e.entity_no LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR street LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR city LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR province LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR mobile_no LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR telephone_no LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR email LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR username LIKE '%".$requestData['search']['value']."%') ";
       $countfilter.="LIMIT ".$requestData['start']." ,".$requestData['length']." " ;

        $getrecordstmt = $con->prepare($countfilter);
        $getrecordstmt->execute() or die("search_individual.php");
        $getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['id'];
        $totalFiltered = $totalData;
     }

     $data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["entity_no"];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["fullname"];
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