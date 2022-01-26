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


$columns = array();



// getting total number records without any search

$sql = "SELECT DISTINCT s.entity_no, s.cbcr, v.Firstname, v.Middlename, v.Lastname, b.bc_name FROM tbl_schedule s inner join tbl_vaccine v on v.entity_no = s.entity_no inner join tbl_bakuna_center b on b.bc_code = s.cbcr GROUP BY s.entity_no ORDER BY s.idno DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . "";
$get_user_data = $con->prepare($sql);
$get_user_data->execute() or die("search_schedule.php");
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter = "SELECT COUNT(s.entity_no) as id FROM tbl_schedule s inner join tbl_vaccine v on s.entity_no = v.entity_no";
//count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_schedule.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT DISTINCT s.entity_no, s.cbcr, v.Firstname, v.Middlename, v.Lastname, b.bc_name FROM tbl_schedule s inner join tbl_vaccine v on v.entity_no = s.entity_no inner join tbl_bakuna_center b on b.bc_code = s.cbcr where";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql .= "  (s.entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR v.Category LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Firstname LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Middlename LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Lastname LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR b.bc_name LIKE '%" . $requestData['search']['value'] . "%' ";

	// $query=mysqli_query($conn, $sql) or die("search_user.php");


	// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql .= " GROUP BY s.entity_no ORDER BY s.idno DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " ";
	$get_user_data = $con->prepare($sql);
	$get_user_data->execute();
	// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
	// $totalFiltered = $totalData;
	// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter = "SELECT COUNT(s.entity_no) as id FROM tbl_schedule s INNER JOIN tbl_vaccine v ON v.entity_no = s.entity_no inner join tbl_bakuna_center b on b.bc_code = s.cbcr where ";
	$countfilter .= "(entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Category LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Firstname LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Middlename LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Lastname LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR b.bc_name LIKE '%" . $requestData['search']['value'] . "%' ";

	$countfilter .= " order by idno DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " "; //count all rows w/ filter
	$getrecordstmt = $con->prepare($countfilter);
	$getrecordstmt->execute() or die("search_schedule.php");
	$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
	$totalData = $getrecord['id'];
	$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
while ($row = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
	$nestedData = array();

	$nestedData[] = $row["entity_no"];
	$nestedData[] = strtoupper($row["Firstname"] . ' ' . $row["Middlename"] . ' ' . $row["Lastname"]);
	$nestedData[] = $row["bc_name"];
	$data[] = $nestedData;
}



$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
