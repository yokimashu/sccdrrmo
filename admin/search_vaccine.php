<?php
/* Database connection start */
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sccdrrmo";
include('../config/db_config.php');
// $office = $_POST['office'];


// echo "<pre>";
// echo print_r("test");
// echo "</pre>";
// $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


 $columns= array( 
// datatable column index  => database column name
	0 =>'entity_no', 
	1 => 'datecreate',
	2 => 'fullname',
	3 => 'gender',
	4 => 'birthdate',
  	5 => 'street',
	  6 => 'barangay',
	  7 => 'MunCity',
	  8 => 'province',
	  9 => 'Region',
	  10 => 'Employed',
	  11 => 'covid_history'
	

	
);



// getting total number records without any search

$sql = "SELECT * FROM tbl_vaccine v inner join tbl_individual i on v.entity_no = i.entity_no ORDER BY idno DESC";
$get_user_data = $con->prepare($sql);
$get_user_data->execute()or die("search_vaccine.php");
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter= "SELECT COUNT(entity_no) as id from tbl_vaccine"; //count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_vaccine.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_vaccine v inner join tbl_individual  i on v.entity_no = i.entity_no where ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.="  (entity_no LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR fullname LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR datecreate LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Category LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR CategoryID LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR idno LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR PhilHealthID LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Civilstatus LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Suffix LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Sex LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Employed LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Profession LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Direct_covid LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Employer_name LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Employer_LGU LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Employer_address LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Employer_contact_no LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR covid_history LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR covid_date LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR covid_classification LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR consent LIKE '%".$requestData['search']['value']."%' )";

// $query=mysqli_query($conn, $sql) or die("search_user.php");


// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY fullname LIMIT ".$requestData['start'].",".$requestData['length']." ";
$get_user_data = $con->prepare($sql);
$get_user_data->execute();
// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
// $totalFiltered = $totalData;
// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter= "SELECT COUNT(v.entity_no) as id  from tbl_vaccine v inner join tbl_individual  i on v.entity_no = i.entity_no  where ";
	$countfilter.="  (entity_no LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR fullname LIKE '%".$requestData['search']['value']."%' ";    
	$countfilter.=" OR datecreate LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR Category LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR CategoryID LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR idno LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR PhilHealthID LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR Civilstatus LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR Suffix LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR Sex LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Employed LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Profession LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Direct_covid LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Employer_name LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Employer_LGU LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Employer_address LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR Employer_contact_no LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR covid_history LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR covid_date LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR covid_classification LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR consent LIKE '%".$requestData['search']['value']."%' )";

$countfilter.=" order by fullname LIMIT ".$requestData['start'].",".$requestData['length']." " ;//count all rows w/ filter
$getrecordstmt = $con->prepare($countfilter);
$getrecordstmt->execute() or die("search_vaccine.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $get_user_data->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["entity_no"];
	$nestedData[] = $row["datecreate"];
	$nestedData[] = $row["fullname"];
	$nestedData[] = $row["gender"];
	$nestedData[] = $row["birthdate"];
    $nestedData[] = $row["street"];
	$nestedData[] = $row["barangay"];
	$nestedData[] = $row["MunCity"];
	$nestedData[] = $row["province"];
	$nestedData[] = $row["Region"];
	$nestedData[] = $row["Employed"];
	$nestedData[] = $row["covid_history"];
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