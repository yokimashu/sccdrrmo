<?php


include('../config/db_config.php');

$numberofrecords = 10;

if (!isset($_POST['searchTerm'])){
    $stmt = $con->prepare("SELECT * FROM tbl_category order by category LIMIT :limit");
    $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
    $stmt->execute();
    $usersList = $stmt->fetchAll();

}else{
    $search = $_POST['searchTerm'];

    $stmt = $con->prepare("SELECT * FROM tbl_category where description like :name order by category LIMIT :limit");
    $stmt->bindValue(':name', '%'.$search.'%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
    $stmt->execute();
    $usersList = $stmt->fetchAll();
 }


$response = array();
 

  foreach ($usersList as $user){
    $response[] = array(
      "category" =>$user['category'],
      "text" =>$user['description']
    );

  }
  


    echo json_encode($response);
    exit();
    
 
    
?>