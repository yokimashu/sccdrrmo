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


);



// getting total number records without any search

$sql = "SELECT * FROM tbl_vaccine v inner join tbl_assessment t on t.entity_no = v.entity_no ORDER BY t.date_reg DESC, t.time_reg DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . "";
$get_user_data = $con->prepare($sql);
$get_user_data->execute() or die("search_vaccine_vas.php");
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter = "SELECT COUNT(v.entity_no) as id FROM tbl_vaccine v inner join tbl_assessment t on t.entity_no = v.entity_no";
//count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_vaccine_vas.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_vaccine v inner join tbl_assessment t on t.entity_no = v.entity_no where";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql .= "  (v.entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Category LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Firstname LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Middlename LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Lastname LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Sex LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Birthdate_ LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR v.Full_address LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $sql .= " OR Barangay LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $sql .= " OR MunCity LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Province LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Region LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR Employed LIKE '%" . $requestData['search']['value'] . "%' ";
	// $sql .= " OR covid_history LIKE '%" . $requestData['search']['value'] . "%' )";

	// $query=mysqli_query($conn, $sql) or die("search_user.php");


	// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql .= " ORDER BY t.date_reg DESC, t.time_reg DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " ";
	$get_user_data = $con->prepare($sql);
	$get_user_data->execute();
	// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
	// $totalFiltered = $totalData;
	// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter = "SELECT COUNT(entity_no) as id FROM tbl_vaccine where ";
	$countfilter .= "(entity_no LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Category LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Firstname LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Middlename LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Lastname LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Sex LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Birthdate_ LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR Full_address LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $countfilter .= " OR Barangay LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $countfilter .= " OR MunCity LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Province LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Region LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Employed LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR covid_history LIKE '%" . $requestData['search']['value'] . "%' )";

	$countfilter .= " order by idno LIMIT " . $requestData['start'] . "," . $requestData['length'] . " "; //count all rows w/ filter
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
	$nestedData[] = $row["date_reg"];
	$nestedData[] = $row["Category"];
	$nestedData[] = strtoupper($row["Firstname"] . ' ' . $row["Middlename"] . ' ' . $row["Lastname"]);
	// $nestedData[] = $row["Sex"];
	$nestedData[] = $row["bakuna_center"];
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
