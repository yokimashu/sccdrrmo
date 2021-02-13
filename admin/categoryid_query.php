<?php


include('../config/db_config.php');

$numberofrecords = 10;
// define ($servername,"localhost");
// define ($username,"root");
// define ($password,"");
// define ($dbname,"scc_doctrack");

// $mysqli = new mysqli($servername, $username, $password, $dbname);
// $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (!isset($_POST['searchTerm'])){
    $stmt = $con->prepare("SELECT * FROM tbl_category_id order by idno asc LIMIT :limit");
    $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
    $stmt->execute();
    $usersList = $stmt->fetchAll();
    // $fetchData = mysqli_query($con,  "SELECT * FROM tbl_documents order by docno LIMIT 10" );
}else{
    $search = $_POST['searchTerm'];

    $stmt = $con->prepare("SELECT * FROM tbl_category_id where categ_id_type like :name order by idno asc LIMIT :limit");
    $stmt->bindValue(':name', '%'.$search.'%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
    $stmt->execute();
    $usersList = $stmt->fetchAll();
 }


$response = array();
 

  foreach ($usersList as $user){
    $response[] = array(
      "id" =>$user['idno'],
      "text" =>$user['categ_id_type']
    );

  }
  


    echo json_encode($response);
    exit();
    
 
    
?>
