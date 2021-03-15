<?php
/* Database connection start */
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sccdrrmo";
include('../config/db_config.php');

session_start();

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array();



// getting total number records without any search

$sql = "SELECT * FROM tbl_assessment a  inner join tbl_vaccine v  on v.entity_no = a.entity_no where a.status = 'VAS' LIMIT " . $requestData['start'] . "," . $requestData['length'] . "";
$get_user_data = $con->prepare($sql);
$get_user_data->execute() or die("search_vaccine_vas.php");
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter = "SELECT COUNT(a.entity_no) as id FROM tbl_assessment a inner join tbl_vaccine v  on v.entity_no = a.entity_no where a.status = 'VAS'";
//count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_vaccine_vas.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT distinct a.entity_no, v.category, concat(v.firstname, ' ', v.middlename, ' ', v.lastname) as fullname, v.sex FROM tbl_assessment a  inner join tbl_vaccine v  on v.entity_no = a.entity_no where a.status = 'VAS' and";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql .= "  a.entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Barangay LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $sql .= " OR MunCity LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Province LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Region LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Employed LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR covid_history LIKE '%" . $requestData['search']['value'] . "%' )";

	// $query=mysqli_query($conn, $sql) or die("search_user.php");


	// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql .= " order by a.date_reg DESC, a.time_reg DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " ";
	$get_user_data = $con->prepare($sql);
	$get_user_data->execute();
	// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
	// $totalFiltered = $totalData;
	// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter = "SELECT COUNT(a.entity_no) as id FROM tbl_assessment a  inner join tbl_vaccine v  on v.entity_no = a.entity_no where a.status = 'VAS' and";
	$countfilter .= " a.entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Barangay LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $countfilter .= " OR MunCity LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Province LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Region LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Employed LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR covid_history LIKE '%" . $requestData['search']['value'] . "%' )";

	$countfilter .= " order by a.date_reg DESC, time_reg DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " "; //count all rows w/ filter
	$getrecordstmt = $con->prepare($countfilter);
	$getrecordstmt->execute() or die("search_vaccine_vas.php");
	$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
	$totalData = $getrecord['id'];
	$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
while ($row = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
	$nestedData = array();

	$nestedData[] = $row["entity_no"];
	$nestedData[] = $row["Category"];
	$nestedData[] = strtoupper($row["Firstname"] . ' ' . $row["Middlename"] . ' ' . $row["Lastname"]);
	$nestedData[] = $row["Sex"];
	// $nestedData[] = $row["Birthdate_"];
	// $nestedData[] = strtoupper($row["Full_address"]);
	// $nestedData[] = $row["Barangay"];
	// $nestedData[] = $row["MunCity"];
	// $nestedData[] = $row["Province"];
	// $nestedData[] = $row["Region"];
	// $nestedData[] = $row["Employed"];
	// $nestedData[] = $row["covid_history"];
	$data[] = $nestedData;
}



$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
