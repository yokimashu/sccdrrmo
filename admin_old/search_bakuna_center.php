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
	// 0 => 'id', 
	// 1 => 'bc_code',
	// 2 => 'bc_name',
	// 3 => 'bc_address'
);



// getting total number records without any search

$sql = "SELECT *  FROM tbl_bakuna_center ";
$get_bakuna_center_data = $con->prepare($sql);
$get_bakuna_center_data->execute();
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter= "SELECT COUNT(idno) as idno from tbl_bakuna_center"; //count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_bakuna_center.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['idno'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_bakuna_center where ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" (idno LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR bc_code LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR bc_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR bc_address LIKE '%".$requestData['search']['value']."%') ";

// $query=mysqli_query($conn, $sql) or die("search_user.php");


// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.="   ORDER BY idno DESC  LIMIT 100  ";
$get_bakuna_center_data = $con->prepare($sql);
$get_bakuna_center_data->execute();
// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
// $totalFiltered = $totalData;
// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter= "SELECT COUNT(idno) as idno from tbl_bakuna_center where ";
	$countfilter.=" (idno LIKE '%".$requestData['search']['value']."%' ";    
	$countfilter.=" OR bc_code LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR bc_name LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR bc_address LIKE '%".$requestData['search']['value']."%') ";

$countfilter.="LIMIT 100 " ;//count all rows w/ filter
$getrecordstmt = $con->prepare($countfilter);
$getrecordstmt->execute() or die("search_bakuna_center.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['idno'];
$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $get_bakuna_center_data->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["bc_code"];
	$nestedData[] = $row["bc_name"];
	$nestedData[] = $row["bc_address"];
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
