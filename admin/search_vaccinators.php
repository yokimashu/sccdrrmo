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
	// 1 => 'n_facility',
	// 2 => 'pr_license_number',
    // 3 => 'f_name',
    // 4 => 'l_name',
    // 5 => 'm_name',
    // 6 => 'position',
    // 7 => 'role'
	


);



// getting total number records without any search

$sql = "SELECT *  FROM tbl_vaccinators ";
$get_vaccinators_data = $con->prepare($sql);
$get_vaccinators_data->execute();
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter= "SELECT COUNT(id) as id from tbl_vaccinators"; //count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_vaccinators.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_vaccinators where ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" (id LIKE '%".$requestData['search']['value']."%' ";    
    $sql.=" OR n_facility LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR pr_license_number LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR l_name LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR f_name LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR m_name LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR position LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR role LIKE '%".$requestData['search']['value']."%' )";

// $query=mysqli_query($conn, $sql) or die("search_user.php");


// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.="   ORDER BY id DESC  LIMIT 100  ";
$get_vaccinators_data = $con->prepare($sql);
$get_vaccinators_data->execute();
// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
// $totalFiltered = $totalData;
// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter= "SELECT COUNT(id) as id from tbl_vaccinators where ";
	$countfilter.=" (id LIKE '%".$requestData['search']['value']."%' ";    
    $countfilter.=" OR n_facility LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR pr_license_number LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR l_name LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR f_name LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR m_name LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR position LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR role LIKE '%".$requestData['search']['value']."%' )";

$countfilter.="LIMIT 100 " ;//count all rows w/ filter
$getrecordstmt = $con->prepare($countfilter);
$getrecordstmt->execute() or die("search_vaccinators.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $get_vaccinators_data->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["n_facility"];
    $nestedData[] = $row["pr_license_number"];
    $nestedData[] = strtoupper($row["f_name"] . ' ' . $row["m_name"] . ' ' . $row["l_name"]);
    $nestedData[] = $row["position"];
    $nestedData[] = $row["role"];
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
