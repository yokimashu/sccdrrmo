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
session_start();

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array(
	// datatable column index  => database column name
	// 0 => 'entity_no',
	// 1 => 'Category',
	// 2 => 'Firstname',
	// 3 => 'Middlename',
	// 4 => 'Lastname',
	// 5 => 'Sex',
	// 6 => 'Birthdate_',
	// 7 => 'Full_address',
	// 8 => 'pfizer',




);



// getting total number records without any search

$sql = "SELECT * FROM tbl_tnxhistory ORDER BY objid DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . "";
$get_user_data = $con->prepare($sql);
$get_user_data->execute() or die("search_logs.php");
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter = "SELECT COUNT(objid) as id from tbl_tnxhistory";
//count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_logs.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_tnxhistory where ";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql .= "  (objid LIKE '%" . $requestData['search']['value'] . "%' ";
	
	$sql .= " OR ref LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR date LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR username LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR activity LIKE '%" . $requestData['search']['value'] . "%' ) ";


	// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql .= "ORDER BY objid DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " ";
	$get_user_data = $con->prepare($sql);
	$get_user_data->execute();
	// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
	// $totalFiltered = $totalData;
	// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter = "SELECT COUNT(objid) as id from tbl_tnxhistory where ";
	$countfilter .= "(objid LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR ref LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR date LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR username LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR activity LIKE '%" . $requestData['search']['value'] . "%') ";
	

	$countfilter .= " order by objid LIMIT ". $requestData['length'] . " "; //count all rows w/ filter
	$getrecordstmt = $con->prepare($countfilter);
	$getrecordstmt->execute() or die("search_logs.php");
	$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
	$totalData = $getrecord['id'];
	$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
while ($row = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
	$nestedData = array();
	$nestedData[] = $row["objid"];
	$nestedData[] = strtoupper($row["ref"]);
	$nestedData[] = $row["date"];
	$nestedData[] = $row["entity_no"];
	$nestedData[] = strtoupper($row["username"]);
	$nestedData[] = $row["activity"];
	$data[] = $nestedData;
}



$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
