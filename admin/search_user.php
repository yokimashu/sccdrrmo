<?php
session_start();
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sccdrrmo";
// $office = $_POST['office'];


$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


 $columns= array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'fullname',
	2 => 'username',
	3 => 'email',
	4 => 'mobileno',
  	 5 => 'status'
	


);



// getting total number records without any search

$sql = "SELECT id, fullname, username, email,  mobileno, status  FROM tbl_users";

$query=mysqli_query($conn, $sql) or die("search_user.php");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT id, fullname, username, email, mobileno, status  FROM tbl_users where";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.="  (id LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR fullname LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR username LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR gender LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR mobileno LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR birthdate LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR account_type LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR status LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("search_user.php");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY id ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";


$query=mysqli_query($conn, $sql) or die("search_user.php");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
	$nestedData[] = $row["fullname"];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["email"];
	$nestedData[] = $row["mobileno"];

  
    $nestedData[] = $row["status"];

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
